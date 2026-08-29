<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motif;

class MotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Motif::query()->delete();

        $motifs = [
            [
                'name'        => 'Geometric Maze',
                'category'    => 'geometris',
                'theme'       => 'minimalis',
                'color'       => 'putih',
                'image_front' => '/motifs/geometris.png',
                'image_back'  => '/motifs/geometris.png',
                'is_active'   => true,
            ],
            [
                'name'        => 'Classic Rose Lineart',
                'category'    => 'floral',
                'theme'       => 'vintage',
                'color'       => 'putih',
                'image_front' => '/motifs/floral.png',
                'image_back'  => '/motifs/floral.png',
                'is_active'   => true,
            ],
            [
                'name'        => 'Abstract Waves',
                'category'    => 'abstrak',
                'theme'       => 'kasual',
                'color'       => 'biru',
                'image_front' => '/motifs/abstrak.png',
                'image_back'  => '/motifs/abstrak.png',
                'is_active'   => true,
            ],
            [
                'name'        => 'Tribal Tattoo Band',
                'category'    => 'tribal',
                'theme'       => 'retro',
                'color'       => 'hitam',
                'image_front' => '/motifs/tribal.png',
                'image_back'  => '/motifs/tribal.png',
                'is_active'   => true,
            ],
            [
                'name'        => 'Jersey Sport Stripe',
                'category'    => 'sporty',
                'theme'       => 'sporty',
                'color'       => 'putih',
                'image_front' => '/motifs/1784597866_sporty.png',
                'image_back'  => '/motifs/1784597866_sporty.png',
                'is_active'   => true,
            ],
            [
                'name'        => 'Retro Classic Sun',
                'category'    => 'geometris',
                'theme'       => 'retro',
                'color'       => 'kuning',
                'image_front' => '/motifs/geometris.png',
                'image_back'  => '/motifs/geometris.png',
                'is_active'   => true,
            ],
            [
                'name'        => 'Classic Ornamental',
                'category'    => 'floral',
                'theme'       => 'vintage',
                'color'       => 'putih',
                'image_front' => '/motifs/floral.png',
                'image_back'  => '/motifs/floral.png',
                'is_active'   => true,
            ],
        ];

        foreach ($motifs as $data) {
            Motif::create($data);
        }
    }
}
