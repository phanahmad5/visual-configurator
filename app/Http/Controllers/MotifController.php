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

        if ($request->filled('category')) {
            $query->where('category', $request->query('category'));
        }

        $motifs = $query->get();

        return response()->json([
            'success' => true,
            'data' => $motifs
        ]);
    }
}
