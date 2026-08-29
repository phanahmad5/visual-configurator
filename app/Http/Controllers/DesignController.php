<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    /**
     * Halaman editor desain baru
     */
    public function create(): View|RedirectResponse
    {
        if (auth()->user()?->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $themes = \App\Models\Template::where('is_active', true)
            ->whereNotNull('theme')
            ->where('theme', '!=', '')
            ->distinct()
            ->pluck('theme')
            ->sort()
            ->values();

        return view('designs.editor', [
            'design' => null,
            'themes' => $themes,
        ]);
    }

    /**
     * Halaman edit desain
     */
    public function edit(Design $design): View
    {
        abort_unless(
            auth()->id() === $design->user_id,
            403,
            'Unauthorized action.'
        );

        $themes = \App\Models\Template::where('is_active', true)
            ->whereNotNull('theme')
            ->where('theme', '!=', '')
            ->distinct()
            ->pluck('theme')
            ->sort()
            ->values();

        return view('designs.editor', compact('design', 'themes'));
    }

    /**
     * Simpan desain baru
     */
    public function store(Request $request): JsonResponse
    {
        // Pastikan user sudah login
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'require_auth' => true,
                'message' => 'Silakan login terlebih dahulu.',
            ], 401);
        }

        // Admin tidak diperbolehkan membuat desain
        if (auth()->user()->role === 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Admin tidak diperbolehkan membuat desain.',
            ], 403);
        }

        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:100',

            'product_type' => [
                'required',
                'in:tshirt,jersey',
            ],

            'shirt_color' => 'required|string|max:50',

            /*
             * canvas_data menyimpan:
             *
             * {
             *     "front": {...},
             *     "back": {...}
             * }
             */
            'canvas_data' => 'required|array',

            // Hasil export gabungan/front/back
            'export_image' => 'nullable|string',
        ]);

        // Simpan hasil export
        $exportImagePath = $this->handleExportImage(
            $validated['export_image'] ?? null
        );

        // Buat desain
        $design = Design::create([
            'user_id' => auth()->id(),

            'name' => $validated['name'],

            'product_type' => $validated['product_type'],

            'shirt_color' => $validated['shirt_color'],

            'canvas_data' => $validated['canvas_data'],

            'export_image' => $exportImagePath,
        ]);

        return response()->json([
            'success' => true,

            'message' => 'Desain berhasil disimpan.',

            'design_id' => $design->id,

            'redirect' => route(
                'designs.edit',
                $design
            ),
        ]);
    }

    /**
     * Update desain
     */
    public function update(
        Request $request,
        Design $design
    ): JsonResponse {

        // Pastikan desain milik user
        abort_unless(
            auth()->id() === $design->user_id,
            403,
            'Unauthorized action.'
        );

        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:100',

            'product_type' => [
                'required',
                'in:tshirt,jersey',
            ],

            'shirt_color' => 'required|string|max:50',

            'canvas_data' => 'required|array',

            'export_image' => 'nullable|string',
        ]);

        // Simpan hasil export baru
        $exportImagePath = $this->handleExportImage(
            $validated['export_image'] ?? null,
            $design->export_image
        );

        // Update desain
        $design->update([
            'name' => $validated['name'],

            'product_type' => $validated['product_type'],

            'shirt_color' => $validated['shirt_color'],

            'canvas_data' => $validated['canvas_data'],

            'export_image' => $exportImagePath,
        ]);

        return response()->json([
            'success' => true,

            'message' => 'Desain berhasil diperbarui.',
        ]);
    }

    /**
     * Decode base64 image dan simpan ke storage.
     */
    private function saveBase64Image(
        string $base64Data
    ): ?string {

        if (
            preg_match(
                '/^data:image\/(\w+);base64,/',
                $base64Data,
                $type
            )
        ) {

            $data = substr(
                $base64Data,
                strpos($base64Data, ',') + 1
            );

            $type = strtolower($type[1]);

            // Hanya izinkan PNG/JPG/JPEG
            if (!in_array($type, [
                'png',
                'jpg',
                'jpeg'
            ])) {
                return null;
            }

            $data = base64_decode($data);

            if ($data === false) {
                return null;
            }

            $fileName =
                'design_' .
                time() .
                '_' .
                uniqid() .
                '.' .
                $type;

            Storage::disk('public')->put(
                'designs/' . $fileName,
                $data
            );

            return 'storage/designs/' . $fileName;
        }

        return null;
    }

    /**
     * Menangani export image.
     */
    private function handleExportImage(
        ?string $exportImage,
        ?string $default = null
    ): ?string {

        // Tidak ada gambar baru
        if (empty($exportImage)) {
            return $default;
        }

        // Base64 image
        if (
            str_starts_with(
                $exportImage,
                'data:image/'
            )
        ) {
            return $this->saveBase64Image(
                $exportImage
            );
        }

        // Jika sudah berupa path
        return $exportImage;
    }

    /**
     * Hapus desain
     */
    public function destroy(
        Design $design
    ): JsonResponse {

        // Pastikan milik user
        abort_unless(
            auth()->id() === $design->user_id,
            403,
            'Unauthorized action.'
        );

        /*
         * Hapus file export jika ada.
         */
        if ($design->export_image) {

            $path = str_replace(
                'storage/',
                '',
                $design->export_image
            );

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        // Hapus database
        $design->delete();

        return response()->json([
            'success' => true,

            'message' => 'Desain berhasil dihapus.',
        ]);
    }
}