<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplateSeeder extends Seeder
{
    /**
     * Seed 20 template berlayer (10 Kaos & 10 Jersey) untuk Content-Based Filtering.
     *
     * Tema yang digunakan (5 tema):
     * - minimalis, retro, vintage, kasual, sporty
     *
     * Setiap template memiliki:
     * - preview_front / preview_back : path gambar preview
     * - design_data (array)          : konfigurasi layer warna & kerah untuk canvas editor
     */
    public function run(): void
    {
        Template::query()->delete();

        $templates = [

            // ============================================================
            // 1. KAOS / T-SHIRT TEMPLATES (10 Items)
            // ============================================================

            // --- Minimalis (2) ---
            [
                'name'          => 'Kaos Minimalis Grid',
                'category'      => 'kaos',
                'color'         => 'putih',
                'theme'         => 'minimalis',
                'preview_front' => '/assets/templates/shirts/design-01/front.png',
                'preview_back'  => '/assets/templates/shirts/design-01/back.png',
                'design_data'   => [
                    'base_color'     => '#ffffff',
                    'accent_color'   => '#94a3b8',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#94a3b8',
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos putih minimalis grid & clean line art.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Kaos Minimalis Monochrome',
                'category'      => 'kaos',
                'color'         => 'hitam',
                'theme'         => 'minimalis',
                'preview_front' => '/assets/templates/shirts/design-01/front.png',
                'preview_back'  => '/assets/templates/shirts/design-01/back.png',
                'design_data'   => [
                    'base_color'     => '#18181b',
                    'accent_color'   => '#71717a',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#71717a',
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos hitam minimalis monochrome sleek typography.',
                'is_active'     => true,
            ],

            // --- Retro (2) ---
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
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos retro synthwave cyber gradient aesthetic.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Kaos Retro Sunset 80s',
                'category'      => 'kaos',
                'color'         => 'oranye',
                'theme'         => 'retro',
                'preview_front' => '/assets/templates/shirts/design-03/front.png',
                'preview_back'  => '/assets/templates/shirts/design-03/back.png',
                'design_data'   => [
                    'base_color'     => '#ea580c',
                    'accent_color'   => '#7c2d12',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#7c2d12',
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos retro bernuansa 80s sunset palm vibes.',
                'is_active'     => true,
            ],

            // --- Vintage (2) ---
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
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos vintage college athletics emblem.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Kaos Classic Heritage',
                'category'      => 'kaos',
                'color'         => 'marun',
                'theme'         => 'vintage',
                'preview_front' => '/assets/templates/shirts/design-04/front.png',
                'preview_back'  => '/assets/templates/shirts/design-04/back.png',
                'design_data'   => [
                    'base_color'     => '#881337',
                    'accent_color'   => '#4c0519',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#4c0519',
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos marun nuansa klasik heritage timur.',
                'is_active'     => true,
            ],

            // --- Kasual (2) ---
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
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos kasual santai urban explorer green.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Kaos Daily Comfort',
                'category'      => 'kaos',
                'color'         => 'abu-abu',
                'theme'         => 'kasual',
                'preview_front' => '/assets/templates/shirts/design-05/front.png',
                'preview_back'  => '/assets/templates/shirts/design-05/back.png',
                'design_data'   => [
                    'base_color'     => '#64748b',
                    'accent_color'   => '#334155',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#334155',
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos kasual harian warna abu-abu elegan.',
                'is_active'     => true,
            ],

            // --- Sporty (2) ---
            [
                'name'          => 'Kaos Active Runner',
                'category'      => 'kaos',
                'color'         => 'navy',
                'theme'         => 'sporty',
                'preview_front' => '/assets/templates/shirts/design-01/front.png',
                'preview_back'  => '/assets/templates/shirts/design-01/back.png',
                'design_data'   => [
                    'base_color'     => '#1e3a8a',
                    'accent_color'   => '#3b82f6',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#3b82f6',
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos sporty active runner navy blue.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Kaos Dynamic Strike',
                'category'      => 'kaos',
                'color'         => 'merah',
                'theme'         => 'sporty',
                'preview_front' => '/assets/templates/shirts/design-02/front.png',
                'preview_back'  => '/assets/templates/shirts/design-02/back.png',
                'design_data'   => [
                    'base_color'     => '#F81234',
                    'accent_color'   => '#1e293b',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#1e293b',
                    'sleeve_color'   => null,
                    'stripe_pattern' => null,
                ],
                'description'   => 'Kaos sporty energik dynamic strike merah.',
                'is_active'     => true,
            ],


            // ============================================================
            // 2. JERSEY SPORT TEMPLATES (10 Items)
            // ============================================================

            // --- Sporty (2) ---
            [
                'name'          => 'Jersey Speed Blue',
                'category'      => 'jersey',
                'color'         => 'biru',
                'theme'         => 'sporty',
                'preview_front' => '/assets/templates/jerseys/design-01/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-01/back.png',
                'design_data'   => [
                    'base_color'     => '#2563eb',
                    'accent_color'   => '#1d4ed8',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#1d4ed8',
                    'sleeve_color'   => '#1d4ed8',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey sport speed blue dynamic stripes.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Jersey Tech Navy',
                'category'      => 'jersey',
                'color'         => 'navy',
                'theme'         => 'sporty',
                'preview_front' => '/assets/templates/jerseys/design-02/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-02/back.png',
                'design_data'   => [
                    'base_color'     => '#000080',
                    'accent_color'   => '#000080',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#000080',
                    'sleeve_color'   => '#000080',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey tech geometric blue navy.',
                'is_active'     => true,
            ],

            // --- Minimalis (2) ---
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
                    'sleeve_color'   => '#0d9488',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey minimal wave white & teal.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Jersey Yellow Stealth',
                'category'      => 'jersey',
                'color'         => 'kuning',
                'theme'         => 'minimalis',
                'preview_front' => '/assets/templates/jerseys/design-03/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-03/back.png',
                'design_data'   => [
                    'base_color'     => '#bee027ff',
                    'accent_color'   => '#f0f3f5ff',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#f0f3f5ff',
                    'sleeve_color'   => '#f0f3f5ff',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey minimalis hitam modern stealth cyan.',
                'is_active'     => true,
            ],

            // --- Retro (2) ---
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
                    'sleeve_color'   => '#7c3aed',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey retro urban camo purple & neon violet.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Jersey Classic Nostalgia',
                'category'      => 'jersey',
                'color'         => 'biru',
                'theme'         => 'retro',
                'preview_front' => '/assets/templates/jerseys/design-01/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-01/back.png',
                'design_data'   => [
                    'base_color'     => '#21098aff',
                    'accent_color'   => '#8278CE',
                    'collar_type'    => 'polo',
                    'collar_color'   => '#8278CE',
                    'sleeve_color'   => '#8278CE',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey retro 90s biru muda.',
                'is_active'     => true,
            ],

            // --- Vintage (2) ---
            [
                'name'          => 'Jersey Classic Club',
                'category'      => 'jersey',
                'color'         => 'hijau',
                'theme'         => 'vintage',
                'preview_front' => '/assets/templates/jerseys/design-04/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-04/back.png',
                'design_data'   => [
                    'base_color'     => '#15803d',
                    'accent_color'   => '#b45309',
                    'collar_type'    => 'henley',
                    'collar_color'   => '#b45309',
                    'sleeve_color'   => '#b45309',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey vintage classic club green gold collar.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Jersey Heritage ',
                'category'      => 'jersey',
                'color'         => 'abu',
                'theme'         => 'vintage',
                'preview_front' => '/assets/templates/jerseys/design-02/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-02/back.png',
                'design_data'   => [
                    'base_color'     => '#7E817F',
                    'accent_color'   => '#7E817F',
                    'collar_type'    => 'polo',
                    'collar_color'   => '#7E817F',
                    'sleeve_color'   => '#7E817F',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey vintage heritage abu tua.',
                'is_active'     => true,
            ],

            // --- Kasual (2) ---
            [
                'name'          => 'Jersey Street Casual',
                'category'      => 'jersey',
                'color'         => 'navy',
                'theme'         => 'kasual',
                'preview_front' => '/assets/templates/jerseys/design-03/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-03/back.png',
                'design_data'   => [
                    'base_color'     => '#0f172a',
                    'accent_color'   => '#f97316',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#f97316',
                    'sleeve_color'   => '#f97316',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey kasual streetwear navy & sunset orange.',
                'is_active'     => true,
            ],
            [
                'name'          => 'Jersey Urban Grey',
                'category'      => 'jersey',
                'color'         => 'abu-abu',
                'theme'         => 'kasual',
                'preview_front' => '/assets/templates/jerseys/design-05/front.png',
                'preview_back'  => '/assets/templates/jerseys/design-05/back.png',
                'design_data'   => [
                    'base_color'     => '#475569',
                    'accent_color'   => '#10b981',
                    'collar_type'    => 'oneck',
                    'collar_color'   => '#10b981',
                    'sleeve_color'   => '#10b981',
                    'stripe_pattern' => null,
                ],
                'description'   => 'Jersey kasual santai grey emerald accent.',
                'is_active'     => true,
            ],

        ];

        foreach ($templates as $data) {
            Template::create($data);
        }
    }
}