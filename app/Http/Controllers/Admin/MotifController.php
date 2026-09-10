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
        'pattern',
        'logo',
        'ornament',
        'badge',
        'icon',
    ];

    public static $themes = [
        'sporty', 'minimalis', 'vintage', 'retro', 'kasual'
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
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
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
        $allowedCategories = array_unique(array_merge(
            self::$categories,
            array_map('strtolower', self::$categories),
            array_map('ucfirst', self::$categories),
            array_map('strtoupper', self::$categories)
        ));

        $validated = $request->validate([
            'name'         => 'nullable|string|max:100',
            'nama'         => 'nullable|string|max:100',
            'category'     => 'nullable|in:' . implode(',', $allowedCategories),
            'kategori'     => 'nullable|in:' . implode(',', $allowedCategories),
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
            'nama'        => $name,
            'category'    => $category,
            'kategori'    => $category,
            'theme'       => $validated['theme'] ?? null,
            'color'       => $validated['color'] ?? null,
            'path_file'   => $frontPath,
            'image_front' => $frontPath,
            'image_back'  => $backPath,
            'description' => $validated['description'] ?? null,
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
        $allowedCategories = array_unique(array_merge(
            self::$categories,
            array_map('strtolower', self::$categories),
            array_map('ucfirst', self::$categories),
            array_map('strtoupper', self::$categories)
        ));

        $validated = $request->validate([
            'name'         => 'nullable|string|max:100',
            'nama'         => 'nullable|string|max:100',
            'category'     => 'nullable|in:' . implode(',', $allowedCategories),
            'kategori'     => 'nullable|in:' . implode(',', $allowedCategories),
            'theme'        => 'nullable|in:' . implode(',', self::$themes),
            'color'        => 'nullable|in:' . implode(',', self::$colors),
            'description'  => 'nullable|string|max:255',
            'image'        => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'image_front'  => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'image_back'   => 'nullable|image|mimes:png,jpg,jpeg,svg|max:5120',
            'is_active'    => 'nullable',
        ]);

        $name = $request->input('name') ?? $request->input('nama') ?? $motif->nama;
        $category = $request->input('category') ?? $request->input('kategori') ?? $motif->kategori;

        $frontPath = $motif->image_front ?? $motif->path_file;
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
            'nama'        => $name,
            'category'    => $category,
            'kategori'    => $category,
            'theme'       => $validated['theme'] ?? $motif->theme,
            'color'       => $validated['color'] ?? $motif->color,
            'path_file'   => $frontPath,
            'image_front' => $frontPath,
            'image_back'  => $backPath ?? $frontPath,
            'description' => $validated['description'] ?? $motif->description,
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
