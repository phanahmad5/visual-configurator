<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TemplateController extends Controller
{
    /**
     * Daftar pilihan atribut template
     */
    public static $categories = ['kaos', 'jersey'];

    public static $colors = [
        'merah', 'biru', 'hitam', 'putih', 'hijau',
        'kuning', 'ungu', 'marun', 'navy', 'army', 'oranye', 'abu-abu'
    ];

    public static $themes = [
        'sporty', 'vintage', 'minimalis', 'retro', 'kasual', 'futuristic'
    ];

    public static $collarTypes = ['vneck', 'oneck', 'polo', 'henley'];

    /**
     * List Template
     */
    public function index(Request $request)
    {
        $query = Template::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('theme', 'like', "%{$search}%")
                  ->orWhere('color', 'like', "%{$search}%");
            });
        }

        $templates = $query->latest()->paginate(10);

        return view('admin.templates.index', [
            'templates' => $templates,
            'search'    => $request->search,
        ]);
    }

    /**
     * Form Tambah
     */
    public function create()
    {
        return view('admin.templates.create', [
            'categories'  => self::$categories,
            'colors'      => self::$colors,
            'themes'      => self::$themes,
            'collarTypes' => self::$collarTypes,
        ]);
    }

    /**
     * Simpan Template Baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:100',
            'category'           => 'required|in:' . implode(',', self::$categories),
            'theme'              => 'required|in:' . implode(',', self::$themes),
            'color'              => 'required|in:' . implode(',', self::$colors),
            'description'        => 'nullable|string|max:255',
            'image'              => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'preview_front_file' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'preview_back_file'  => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'design_front'       => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'design_back'        => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'base_color'         => 'nullable|string|max:20',
            'accent_color'       => 'nullable|string|max:20',
            'collar_type'        => 'nullable|in:' . implode(',', self::$collarTypes),
            'collar_color'       => 'nullable|string|max:20',
            'sleeve_color'       => 'nullable|string|max:20',
            'is_active'          => 'nullable',
        ]);

        // Upload preview_front (dukung preview_front_file, image, atau design_front)
        $previewFrontPath = null;
        $frontFile = $request->file('preview_front_file') ?? $request->file('image') ?? $request->file('design_front');
        if ($frontFile) {
            $filename = time() . '_front_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $frontFile->getClientOriginalName());
            $frontFile->move(public_path('templates/previews'), $filename);
            $previewFrontPath = '/templates/previews/' . $filename;
        }

        // Upload preview_back (dukung preview_back_file atau design_back)
        $previewBackPath = null;
        $backFile = $request->file('preview_back_file') ?? $request->file('design_back');
        if ($backFile) {
            $filename = time() . '_back_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $backFile->getClientOriginalName());
            $backFile->move(public_path('templates/previews'), $filename);
            $previewBackPath = '/templates/previews/' . $filename;
        }

        // Build design_data array
        $designData = [
            'base_color'     => $request->input('base_color')   ?: null,
            'accent_color'   => $request->input('accent_color') ?: null,
            'collar_type'    => $request->input('collar_type')  ?: 'oneck',
            'collar_color'   => $request->input('collar_color') ?: null,
            'sleeve_color'   => $request->input('sleeve_color') ?: null,
            'stripe_pattern' => null,
        ];

        Template::create([
            'name'          => $validated['name'],
            'category'      => $validated['category'],
            'theme'         => $validated['theme'],
            'color'         => $validated['color'],
            'preview_front' => $previewFrontPath,
            'preview_back'  => $previewBackPath ?? $previewFrontPath,
            'design_data'   => $designData,
            'description'   => $validated['description'] ?? null,
            'is_active'     => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil ditambahkan.');
    }

    /**
     * Form Edit
     */
    public function edit(Template $template)
    {
        return view('admin.templates.edit', [
            'template'    => $template,
            'categories'  => self::$categories,
            'colors'      => self::$colors,
            'themes'      => self::$themes,
            'collarTypes' => self::$collarTypes,
        ]);
    }

    /**
     * Update Template
     */
    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:100',
            'category'           => 'required|in:' . implode(',', self::$categories),
            'theme'              => 'required|in:' . implode(',', self::$themes),
            'color'              => 'required|in:' . implode(',', self::$colors),
            'description'        => 'nullable|string|max:255',
            'image'              => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'preview_front_file' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'preview_back_file'  => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
            'design_front'       => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'design_back'        => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'base_color'         => 'nullable|string|max:20',
            'accent_color'       => 'nullable|string|max:20',
            'collar_type'        => 'nullable|in:' . implode(',', self::$collarTypes),
            'collar_color'       => 'nullable|string|max:20',
            'sleeve_color'       => 'nullable|string|max:20',
            'is_active'          => 'nullable',
        ]);

        // Update preview_front
        $previewFrontPath = $template->preview_front;
        $frontFile = $request->file('preview_front_file') ?? $request->file('image') ?? $request->file('design_front');
        if ($frontFile) {
            if ($template->preview_front && File::exists(public_path($template->preview_front))) {
                File::delete(public_path($template->preview_front));
            }
            $filename = time() . '_front_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $frontFile->getClientOriginalName());
            $frontFile->move(public_path('templates/previews'), $filename);
            $previewFrontPath = '/templates/previews/' . $filename;
        }

        // Update preview_back
        $previewBackPath = $template->preview_back;
        $backFile = $request->file('preview_back_file') ?? $request->file('design_back');
        if ($backFile) {
            if ($template->preview_back && $template->preview_back !== $template->preview_front && File::exists(public_path($template->preview_back))) {
                File::delete(public_path($template->preview_back));
            }
            $filename = time() . '_back_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $backFile->getClientOriginalName());
            $backFile->move(public_path('templates/previews'), $filename);
            $previewBackPath = '/templates/previews/' . $filename;
        }

        // Safely extract and decode existing design_data
        $existingData = $template->design_data;
        if (is_string($existingData)) {
            $existingData = json_decode($existingData, true);
            if (is_string($existingData)) {
                $existingData = json_decode($existingData, true);
            }
        }
        if (!is_array($existingData)) {
            $existingData = [];
        }

        $inputData = array_filter([
            'base_color'   => $request->input('base_color')   ?: ($existingData['base_color']   ?? null),
            'accent_color' => $request->input('accent_color') ?: ($existingData['accent_color'] ?? null),
            'collar_type'  => $request->input('collar_type')  ?: ($existingData['collar_type']  ?? 'oneck'),
            'collar_color' => $request->input('collar_color') ?: ($existingData['collar_color'] ?? null),
            'sleeve_color' => $request->input('sleeve_color') ?: ($existingData['sleeve_color'] ?? null),
        ], fn($v) => $v !== null);

        $designData = array_merge($existingData, $inputData);

        $template->update([
            'name'          => $validated['name'],
            'category'      => $validated['category'],
            'theme'         => $validated['theme'],
            'color'         => $validated['color'],
            'preview_front' => $previewFrontPath,
            'preview_back'  => $previewBackPath ?? $previewFrontPath,
            'design_data'   => $designData,
            'description'   => $validated['description'] ?? $template->description,
            'is_active'     => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    /**
     * Hapus Template
     */
    public function destroy(Template $template)
    {
        if ($template->preview_front && File::exists(public_path($template->preview_front))) {
            File::delete(public_path($template->preview_front));
        }
        if ($template->preview_back && File::exists(public_path($template->preview_back))) {
            File::delete(public_path($template->preview_back));
        }

        $template->delete();

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil dihapus.');
    }
}
