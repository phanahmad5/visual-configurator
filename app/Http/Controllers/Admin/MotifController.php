<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MotifController extends Controller
{
    /**
     * Daftar kategori motif (sesuai rekomendasi pembimbing)
     */
    public static $categories = [
        'geometris',
        'floral',
        'abstrak',
        'tribal',
        'sporty',
        'vintage',
        'retro',
    ];

    public static $themes = [
        'sporty', 'minimalis', 'vintage', 'retro', 'kasual', 'futuristic'
    ];

    public static $colors = [
        'putih', 'hitam', 'merah', 'biru', 'hijau', 'kuning', 'ungu', 'marun'
    ];

    /**
     * Daftar motif
     */
    public function index(Request $request)
    {
        $query = Motif::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $motifs = $query->latest()->paginate(10);

        return view('admin.motifs.index', [
            'motifs' => $motifs,
            'search' => $request->search,
        ]);
    }

    /**
     * Form tambah motif
     */
    public function create()
    {
        return view('admin.motifs.create', [
            'categories' => self::$categories,
            'themes'     => self::$themes,
            'colors'     => self::$colors,
        ]);
    }

    /**
     * Simpan motif
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'nullable|string|max:100',
            'nama'         => 'nullable|string|max:100',
            'category'     => 'nullable|in:' . implode(',', self::$categories),
            'kategori'     => 'nullable|in:' . implode(',', self::$categories),
            'theme'        => 'nullable|in:' . implode(',', self::$themes),
            'color'        => 'nullable|in:' . implode(',', self::$colors),
            'description'  => 'nullable|string|max:255',
            'image'        => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'image_front'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'image_back'   => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'is_active'    => 'nullable',
        ]);

        $name = $request->input('name') ?? $request->input('nama');
        $category = $request->input('category') ?? $request->input('kategori');

        if (!$name) {
            return back()->withErrors(['nama' => 'Nama motif wajib diisi.'])->withInput();
        }
        if (!$category) {
            return back()->withErrors(['kategori' => 'Kategori motif wajib dipilih.'])->withInput();
        }

        // Upload image_front
        $frontPath = null;
        $frontFile = $request->file('image_front') ?? $request->file('image');
        if ($frontFile) {
            $filename = time() . '_front_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $frontFile->getClientOriginalName());
            $frontFile->move(public_path('motifs'), $filename);
            $frontPath = '/motifs/' . $filename;
        }

        // Upload image_back
        $backFile = $request->file('image_back');
        $backPath = $frontPath;
        if ($backFile) {
            $filename = time() . '_back_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $backFile->getClientOriginalName());
            $backFile->move(public_path('motifs'), $filename);
            $backPath = '/motifs/' . $filename;
        }

        Motif::create([
            'name'        => $name,
            'category'    => $category,
            'theme'       => $validated['theme'] ?? null,
            'color'       => $validated['color'] ?? null,
            'image_front' => $frontPath,
            'image_back'  => $backPath,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.motifs.index')
            ->with('success', 'Motif berhasil ditambahkan.');
    }

    /**
     * Form edit motif
     */
    public function edit(Motif $motif)
    {
        return view('admin.motifs.edit', [
            'motif'      => $motif,
            'categories' => self::$categories,
            'themes'     => self::$themes,
            'colors'     => self::$colors,
        ]);
    }

    /**
     * Update motif
     */
    public function update(Request $request, Motif $motif)
    {
        $validated = $request->validate([
            'name'         => 'nullable|string|max:100',
            'nama'         => 'nullable|string|max:100',
            'category'     => 'nullable|in:' . implode(',', self::$categories),
            'kategori'     => 'nullable|in:' . implode(',', self::$categories),
            'theme'        => 'nullable|in:' . implode(',', self::$themes),
            'color'        => 'nullable|in:' . implode(',', self::$colors),
            'description'  => 'nullable|string|max:255',
            'image'        => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'image_front'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'image_back'   => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'is_active'    => 'nullable',
        ]);

        $name = $request->input('name') ?? $request->input('nama') ?? $motif->name;
        $category = $request->input('category') ?? $request->input('kategori') ?? $motif->category;

        $frontPath = $motif->image_front;
        $frontFile = $request->file('image_front') ?? $request->file('image');
        if ($frontFile) {
            if ($motif->image_front && File::exists(public_path($motif->image_front))) {
                File::delete(public_path($motif->image_front));
            }
            $filename = time() . '_front_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $frontFile->getClientOriginalName());
            $frontFile->move(public_path('motifs'), $filename);
            $frontPath = '/motifs/' . $filename;
        }

        $backPath = $motif->image_back;
        $backFile = $request->file('image_back');
        if ($backFile) {
            if ($motif->image_back && $motif->image_back !== $motif->image_front && File::exists(public_path($motif->image_back))) {
                File::delete(public_path($motif->image_back));
            }
            $filename = time() . '_back_' . preg_replace('/[^A-Za-z0-9_.-]/', '_', $backFile->getClientOriginalName());
            $backFile->move(public_path('motifs'), $filename);
            $backPath = '/motifs/' . $filename;
        }

        $motif->update([
            'name'        => $name,
            'category'    => $category,
            'theme'       => $validated['theme'] ?? $motif->theme,
            'color'       => $validated['color'] ?? $motif->color,
            'image_front' => $frontPath,
            'image_back'  => $backPath ?? $frontPath,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()
            ->route('admin.motifs.index')
            ->with('success', 'Motif berhasil diperbarui.');
    }

    /**
     * Hapus motif
     */
    public function destroy(Motif $motif)
    {
        if ($motif->image_front && File::exists(public_path($motif->image_front))) {
            File::delete(public_path($motif->image_front));
        }
        if ($motif->image_back && $motif->image_back !== $motif->image_front && File::exists(public_path($motif->image_back))) {
            File::delete(public_path($motif->image_back));
        }

        $motif->delete();

        return redirect()
            ->route('admin.motifs.index')
            ->with('success', 'Motif berhasil dihapus.');
    }
}
}
