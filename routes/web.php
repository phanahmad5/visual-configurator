<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Root redirect based on role
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard');
    }
    return view('welcome');
});

// User Dashboard (role: user)
Route::get('/dashboard', function () {
    $designs = auth()->user()
        ->designs()
        ->orderBy('updated_at', 'desc')
        ->get();

    $totalDesignsCount = $designs->count();
    $latestDesign = $designs->first();
    $templatesCount = \App\Models\Template::where('is_active', true)->count();

    return view('dashboard', compact('designs', 'totalDesignsCount', 'latestDesign', 'templatesCount'));
})->middleware(['auth', 'verified', 'role.user'])->name('dashboard');
// Admin Routes (role: admin)
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $stats = [
            'users_count' => \App\Models\User::count(),
            'templates_count' => \App\Models\Template::count(),
            'designs_count' => \App\Models\Design::count(),
            'motifs_count' => \App\Models\Motif::count(),
        ];

        $recent_activities = collect();

        // Recent designs
        try {
            $recent_designs = \App\Models\Design::with('user')->latest()->take(5)->get();
            foreach ($recent_designs as $design) {
                $userName = $design->user ? $design->user->name : 'User';
                $isNew = $design->created_at && $design->created_at->equalTo($design->updated_at);
                $action = $isNew ? "membuat desain baru" : "mengedit desain";
                if (!empty($design->name)) {
                    $action .= " (" . $design->name . ")";
                }
                $recent_activities->push([
                    'description' => "{$userName} {$action}",
                    'time' => $design->updated_at ? $design->updated_at->diffForHumans() : 'Baru saja',
                    'timestamp' => $design->updated_at ? $design->updated_at->timestamp : 0,
                    'icon' => 'design'
                ]);
            }
        } catch (\Exception $e) {}

        // Recent templates
        try {
            $recent_templates = \App\Models\Template::latest()->take(3)->get();
            foreach ($recent_templates as $tmpl) {
                $recent_activities->push([
                    'description' => "Template baru ditambahkan" . (!empty($tmpl->name) ? " ({$tmpl->name})" : ""),
                    'time' => $tmpl->created_at ? $tmpl->created_at->diffForHumans() : 'Baru saja',
                    'timestamp' => $tmpl->created_at ? $tmpl->created_at->timestamp : 0,
                    'icon' => 'template'
                ]);
            }
        } catch (\Exception $e) {}

        // Recent users
        try {
            $recent_users = \App\Models\User::latest()->take(3)->get();
            foreach ($recent_users as $user) {
                $recent_activities->push([
                    'description' => "User baru terdaftar ({$user->name})",
                    'time' => $user->created_at ? $user->created_at->diffForHumans() : 'Baru saja',
                    'timestamp' => $user->created_at ? $user->created_at->timestamp : 0,
                    'icon' => 'user'
                ]);
            }
        } catch (\Exception $e) {}

        $recent_activities = $recent_activities->sortByDesc('timestamp')->take(6)->values();

        return view('admin.dashboard', array_merge($stats, ['recent_activities' => $recent_activities]));
    })->name('dashboard');

    Route::resource('templates', \App\Http\Controllers\Admin\TemplateController::class);
    Route::resource('motifs', \App\Http\Controllers\Admin\MotifController::class);
});

// Public Design & Recommendation routes
Route::get('/designs/new', [\App\Http\Controllers\DesignController::class, 'create'])->name('designs.create');
Route::post('/recommendations', [\App\Http\Controllers\RecommendationController::class, 'recommend'])->name('recommendations.get');
Route::get('/api/motifs', [\App\Http\Controllers\MotifController::class, 'index'])->name('api.motifs');
Route::post('/designs', [\App\Http\Controllers\DesignController::class, 'store'])->name('designs.store');

// Protected Design routes (role: user)
Route::middleware(['auth', 'verified', 'role.user'])->group(function () {
    Route::get('/designs/{design}/edit', [\App\Http\Controllers\DesignController::class, 'edit'])->name('designs.edit');
    Route::put('/designs/{design}', [\App\Http\Controllers\DesignController::class, 'update'])->name('designs.update');
    Route::delete('/designs/{design}', [\App\Http\Controllers\DesignController::class, 'destroy'])->name('designs.destroy');
});

// Profile routes (semua user yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
