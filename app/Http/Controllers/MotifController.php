<?php

namespace App\Http\Controllers;

use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MotifController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Motif::where('is_active', true);

        $category = $request->query('category') ?? $request->query('kategori');
        if ($category) {
            $query->where(function ($q) use ($category) {
                $q->where('category', $category)
                  ->orWhere('kategori', $category);
            });
        }

        $motifs = $query->get();

        return response()->json([
            'success' => true,
            'data' => $motifs
        ]);
    }
}
