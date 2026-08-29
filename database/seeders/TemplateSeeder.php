<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Seed template berlayer sesuai rekomendasi pembimbing skripsi.
     *
     * Setiap template memiliki:
     * - preview_front / preview_back : gambar PNG mockup untuk kartu rekomendasi
     * - design_data (array)          : data layer yang dapat dikustomisasi di editor
     *   └── base_color      : warna utama badan kaos/jersey (hex)
     *   └── accent_color    : warna aksen (strip, piping, sleeve cuff)
     *   └── collar_type     : bentuk kerah (vneck / oneck / polo / henley)
     *   └── collar_color    : warna kerah
     *   └── sleeve_color    : warna lengan / cuff
     *   └── stripe_pattern  : path motif stripe (null = polos)
     *
     * design_data disimpan sebagai PHP array — Model::$casts['design_data'] = 'array'
     * akan otomatis mengkonversi ke/dari JSON di database.
     */
    public function run(): void
    {
        Template::query()->delete();

        $templates = [

            // ============================================================
            // KAOS / T-SHIRT TEMPLATES
            // ============================================================

            [
                'name'          => 'Kaos Futuristic Dark',
                'category'      => 'kaos',
                'color'         => 'hitam',
                'theme'         => 'futuristic',
                'preview_front' => '/assets/templates/shirts/design-01/front.png',
                'preview_back'  => '/assets/templates/shirts/design-01/back.png',
                'design_data'   => [
                    'base_color'     => '#0f0f0f',
                    'accent_color'   => '#c89b3c',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#c89b3c',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos hitam futuristic gold — FUTURE IS NOW.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Kaos Minimalis Grid',
                'category'      => 'kaos',
                'color'         => 'putih',
                'theme'         => 'minimalis',
                'preview_front' => '/assets/templates/shirts/design-02/front.png',
                'preview_back'  => '/assets/templates/shirts/design-02/back.png',
                'design_data'   => [
                    'base_color'     => '#ffffff',
                    'accent_color'   => '#94a3b8',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#94a3b8',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos minimalis grid & circle line art.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Kaos Retro Synthwave',
                'category'      => 'kaos',
                'color'         => 'hitam',
                'theme'         => 'retro',
                'preview_front' => '/assets/templates/shirts/design-03/front.png',
                'preview_back'  => '/assets/templates/shirts/design-03/back.png',
                'design_data'   => [
                    'base_color'     => '#111212',
                    'accent_color'   => '#7c3aed',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#7c3aed',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos retro synthwave cyber vibes.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Kaos Vintage Athletics',
                'category'      => 'kaos',
                'color'         => 'kuning',
                'theme'         => 'vintage',
                'preview_front' => '/assets/templates/shirts/design-04/front.png',
                'preview_back'  => '/assets/templates/shirts/design-04/back.png',
                'design_data'   => [
                    'base_color'     => '#eab308',
                    'accent_color'   => '#78350f',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#78350f',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos vintage athletics emblem.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Kaos Urban Explorer',
                'category'      => 'kaos',
                'color'         => 'hijau',
                'theme'         => 'kasual',
                'preview_front' => '/assets/templates/shirts/design-05/front.png',
                'preview_back'  => '/assets/templates/shirts/design-05/back.png',
                'design_data'   => [
                    'base_color'     => '#16a34a',
                    'accent_color'   => '#052e16',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#052e16',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos kasual urban explorer green.',
                'is_active'     => true,
            ],

            // ============================================================
            // JERSEY SPORT TEMPLATES
            // ============================================================

            [
                'name'          => 'Jersey Speed Blue',
                'category'      => 'jersey',
                'color'         => 'biru',
                'theme'         => 'sporty',
                'preview_front' => '/assets/templates/jerseys/design-01/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-01/back.png',
                'design_data'   => [
                    'base_color'     => '#ffffff',
                    'accent_color'   => '#2563eb',
                    'collar_type'    => 'vneck',
                    'collar_color'   => '#1d4ed8',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey sport speed blue dynamic stripes.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Jersey Tech Red Black',
                'category'      => 'jersey',
                'color'         => 'merah',
                'theme'         => 'sporty',
                'preview_front' => '/assets/templates/jerseys/design-02/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-02/back.png',
                'design_data'   => [
                    'base_color'     => '#252392ff',
                    'accent_color'   => '#1d51e1ff',
                    'collar_type'    => 'vneck',
                    'collar_color'   => '#1d51e1ff',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey tech geometric red & black.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Jersey Elegant Dark Gold',
                'category'      => 'jersey',
                'color'         => 'hitam',
                'theme'         => 'sporty',
                'preview_front' => '/assets/templates/jerseys/design-03/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-03/back.png',
                'design_data'   => [
                    'base_color'     => '#0f0f0f',
                    'accent_color'   => '#c89b3c',
                    'collar_type'    => 'vneck',
                    'collar_color'   => '#c89b3c',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey elegant modern dark gold.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Jersey Minimal Teal',
                'category'      => 'jersey',
                'color'         => 'putih',
                'theme'         => 'minimalis',
                'preview_front' => '/assets/templates/jerseys/design-04/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-04/back.png',
                'design_data'   => [
                    'base_color'     => '#ffffff',
                    'accent_color'   => '#0d9488',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#0d9488',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey minimal wave white & teal.',
                'is_active'     => true,
            ],

            [
                'name'          => 'Jersey Urban Camo Purple',
                'category'      => 'jersey',
                'color'         => 'ungu',
                'theme'         => 'retro',
                'preview_front' => '/assets/templates/jerseys/design-05/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-05/back.png',
                'design_data'   => [
                    'base_color'     => '#1e0a3c',
                    'accent_color'   => '#7c3aed',
                    'collar_type'    => 'vneck',
                    'collar_color'   => '#7c3aed',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey urban camo purple & black.',
                'is_active'     => true,
            ],

        ];

        foreach ($templates as $data) {
            Template::create($data);
        }
    }
}