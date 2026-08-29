<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Design;
use Carbon\Carbon;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        if ($users->isEmpty()) {
            return;
        }

        $sampleDesigns = [
            [
                'name' => 'Dynamic Brush',
                'product_type' => 'jersey',
                'shirt_color' => '#ffffff',
                'canvas_data' => [
                    'front' => ['objects' => []],
                    'back' => ['objects' => []]
                ],
                'export_image' => 'templates/jersey/preview/jersey_dynamic_brush.png',
                'updated_sub' => ['minutes' => 5],
            ],
            [
                'name' => 'Elegant Modern',
                'product_type' => 'jersey',
                'shirt_color' => '#ffffff',
                'canvas_data' => [
                    'front' => ['objects' => []],
                    'back' => ['objects' => []]
                ],
                'export_image' => 'templates/jersey/preview/jersey_elegant_modern.png',
                'updated_sub' => ['days' => 1],
            ],
            [
                'name' => 'Minimal Wave',
                'product_type' => 'jersey',
                'shirt_color' => '#ffffff',
                'canvas_data' => [
                    'front' => ['objects' => []],
                    'back' => ['objects' => []]
                ],
                'export_image' => 'templates/jersey/preview/jersey_minimal_wave.png',
                'updated_sub' => ['days' => 3],
            ],
            [
                'name' => 'Tech Geometric',
                'product_type' => 'jersey',
                'shirt_color' => '#ffffff',
                'canvas_data' => [
                    'front' => ['objects' => []],
                    'back' => ['objects' => []]
                ],
                'export_image' => 'templates/jersey/preview/jersey_tech_geometric.png',
                'updated_sub' => ['weeks' => 1],
            ],
        ];

        foreach ($users as $user) {
            // Delete broken design placeholders like Desain 1 or Desain1
            Design::where('user_id', $user->id)
                ->whereIn('name', ['Desain 1', 'Desain1', 'Desain 1', 'Desain1'])
                ->delete();

            foreach ($sampleDesigns as $sample) {
                $design = Design::where('user_id', $user->id)
                    ->where('name', $sample['name'])
                    ->first();

                $timestamp = now();
                if (isset($sample['updated_sub']['minutes'])) {
                    $timestamp = now()->subMinutes($sample['updated_sub']['minutes']);
                } elseif (isset($sample['updated_sub']['days'])) {
                    $timestamp = now()->subDays($sample['updated_sub']['days']);
                } elseif (isset($sample['updated_sub']['weeks'])) {
                    $timestamp = now()->subWeeks($sample['updated_sub']['weeks']);
                }

                if (!$design) {
                    Design::create([
                        'user_id' => $user->id,
                        'name' => $sample['name'],
                        'product_type' => $sample['product_type'],
                        'shirt_color' => $sample['shirt_color'],
                        'canvas_data' => $sample['canvas_data'],
                        'export_image' => $sample['export_image'],
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ]);
                } else {
                    $design->update([
                        'export_image' => $sample['export_image'],
                    ]);
                }
            }
        }
    }
}
