<?php

namespace App\Http\Controllers;

use App\Models\RecommendationLog;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecommendationController extends Controller
{
    /**
     * Content-Based Filtering
     * Weighted Attribute Matching
     */
    public function recommend(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category' => 'nullable|string',
            'theme'    => 'nullable|string',
            'color'    => 'nullable|string',
        ]);

        // Bobot atribut
        $weightCategory = 0.50;
        $weightTheme    = 0.30;
        $weightColor    = 0.20;

        // Ambil semua template aktif — jangan filter category di sini.
        // Category adalah atribut yang harus ikut dihitung dalam Weighted Attribute Matching.
        // Memfilter sebelum matching menyebabkan template dengan category berbeda
        // tidak pernah ikut proses perhitungan, sehingga ranking menjadi tidak valid.
        $templates = Template::where('is_active', true)->get();

        $results = [];

        foreach ($templates as $template) {

            $score = 0;
            $categoryMatch = 0;
            $themeMatch = 0;
            $colorMatch = 0;

            // Category (50%)
            if (
                !empty($validated['category']) &&
                strcasecmp(trim($validated['category']), trim($template->category)) === 0
            ) {
                $categoryMatch = 1;
                $score += $weightCategory;
            }

            // Theme (30%)
            if (
                !empty($validated['theme']) &&
                strcasecmp(trim($validated['theme']), trim($template->theme)) === 0
            ) {
                $themeMatch = 1;
                $score += $weightTheme;
            }

            // Color (20%)
            if (
                !empty($validated['color']) &&
                strcasecmp(trim($validated['color']), trim($template->color)) === 0
            ) {
                $colorMatch = 1;
                $score += $weightColor;
            }

            $previewFront = $template->preview_front ?? $template->image_path ?? null;
            $previewBack  = $template->preview_back ?? $template->design_back_path ?? $previewFront;

            $results[] = [

                'id' => $template->id,

                'name' => $template->name,

                'category' => $template->category,

                'theme' => $template->theme,

                'color' => $template->color,

                'preview_front' => $previewFront,

                'preview_back' => $previewBack,

                'image_path' => $previewFront,

                'design_path' => $template->design_path ?? null,

                'design_front_path' => $template->design_front_path ?? $previewFront,

                'design_back_path' => $previewBack,

                'design_data' => $template->design_data ?? null,

                'description' => $template->description,

                'score' => round($score, 2),

                'percentage' => round($score * 100, 0),

                'matches' => [
                    'category' => $categoryMatch,
                    'theme' => $themeMatch,
                    'color' => $colorMatch,
                ]

            ];
        }

        // Urutkan skor terbesar, jika sama urutkan berdasarkan id terkecil
        usort($results, function ($a, $b) {

            if ($b['score'] === $a['score']) {
                return $a['id'] <=> $b['id'];
            }

            return $b['score'] <=> $a['score'];

        });

        // Simpan histori jika user login
        if (auth()->check()) {

            foreach (array_slice($results, 0, 5) as $index => $item) {

                RecommendationLog::create([

                    'user_id' => auth()->id(),

                    'template_id' => $item['id'],

                    'category_input' => $validated['category'] ?? '',

                    'theme_input' => $validated['theme'] ?? '',

                    'color_input' => $validated['color'] ?? '',

                    'score' => $item['score'],

                    'ranking' => $index + 1

                ]);

            }

        }

        return response()->json([

            'success' => true,

            'method' => 'Content-Based Filtering (Weighted Attribute Matching)',

            'weights' => [

                'category' => $weightCategory,

                'theme' => $weightTheme,

                'color' => $weightColor

            ],

            'data' => $results

        ]);
    }
}