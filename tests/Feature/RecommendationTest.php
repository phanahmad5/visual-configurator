<?php

namespace Tests\Feature;

use App\Models\Template;
use Database\Seeders\TemplateSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecommendationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test recommendation system for jersey sporty black returns Elegant Modern with 100% score,
     * correct image_path and design_path.
     */
    public function test_recommendation_system_for_jersey_sporty_black(): void
    {
        $this->seed(TemplateSeeder::class);

        $response = $this->postJson(
            route('recommendations.get'),
            [
                'category' => 'jersey',
                'theme' => 'sporty',
                'color' => 'hitam',
            ]
        );

        $response->assertStatus(200);

        $data = $response->json('data');

        $this->assertNotEmpty($data);
        $this->assertEquals('Elegant Modern', $data[0]['name']);
        $this->assertEquals('jersey', $data[0]['category']);
        $this->assertEquals(100, $data[0]['percentage']);
        $this->assertEquals(1.0, $data[0]['score']);
        $this->assertEquals('/templates/jersey/preview/jersey_elegant_modern.png', $data[0]['image_path']);
        $this->assertEquals('/templates/jersey/design/front/elegant-modern.png', $data[0]['design_front_path']);
        $this->assertEquals('/templates/jersey/design/back/elegant-modern.png', $data[0]['design_back_path']);
    }

    /**
     * Test that all 5 seeded jersey templates are returned, have unique image_path & design_path,
     * and image_path != design_path for all templates.
     */
    public function test_all_jersey_templates_paths_and_uniqueness(): void
    {
        $this->seed(TemplateSeeder::class);

        $response = $this->postJson(
            route('recommendations.get'),
            [
                'category' => 'jersey',
            ]
        );

        $response->assertStatus(200);

        $data = $response->json('data');

        $jerseyCount = Template::where('category', 'jersey')->where('is_active', true)->count();
        $this->assertCount($jerseyCount, $data);

        $imagePaths = [];
        $designPaths = [];

        foreach ($data as $item) {
            $this->assertEquals('jersey', $item['category']);
            $this->assertArrayHasKey('image_path', $item);
            $this->assertArrayHasKey('design_front_path', $item);
            $this->assertArrayHasKey('design_back_path', $item);
            $this->assertNotEmpty($item['image_path']);
            $this->assertNotEmpty($item['design_front_path']);
            $this->assertNotEmpty($item['design_back_path']);

            // Ensure image_path != design_front_path
            $this->assertNotEquals($item['image_path'], $item['design_front_path']);

            $imagePaths[] = $item['image_path'];
            $designPaths[] = $item['design_front_path'];
        }

        // Ensure all jersey templates have unique image_path and design_path
        $this->assertCount($jerseyCount, array_unique($imagePaths));
        $this->assertCount($jerseyCount, array_unique($designPaths));
    }

    /**
     * Test inactive templates are not recommended.
     */
    public function test_inactive_templates_are_excluded(): void
    {
        Template::create([
            'name' => 'Inactive Template',
            'category' => 'jersey',
            'color' => 'hitam',
            'theme' => 'sporty',
            'image_path' => '/templates/jersey/jersey_inactive.png',
            'design_path' => '/templates/jersey/design/inactive.png',
            'is_active' => false,
        ]);

        $response = $this->postJson(
            route('recommendations.get'),
            [
                'category' => 'jersey',
            ]
        );

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertCount(0, $data);
    }

    /**
     * Test sorting based on score DESC.
     */
    public function test_recommendation_sorting_by_score_desc(): void
    {
        Template::create([
            'name' => 'Match 100',
            'category' => 'kaos',
            'color' => 'hitam',
            'theme' => 'minimalis',
            'image_path' => '/templates/kaos/preview/a.png',
            'design_path' => '/templates/kaos/design/a.png',
            'is_active' => true,
        ]);

        Template::create([
            'name' => 'Match 70',
            'category' => 'kaos',
            'color' => 'hitam',
            'theme' => 'sporty',
            'image_path' => '/templates/kaos/preview/b.png',
            'design_path' => '/templates/kaos/design/b.png',
            'is_active' => true,
        ]);

        Template::create([
            'name' => 'Match 50',
            'category' => 'kaos',
            'color' => 'putih',
            'theme' => 'sporty',
            'image_path' => '/templates/kaos/preview/c.png',
            'design_path' => '/templates/kaos/design/c.png',
            'is_active' => true,
        ]);

        $response = $this->postJson(
            route('recommendations.get'),
            [
                'category' => 'kaos',
                'color' => 'hitam',
                'theme' => 'minimalis',
            ]
        );

        $response->assertStatus(200);
        $data = $response->json('data');

        $this->assertCount(3, $data);
        $this->assertEquals('Match 100', $data[0]['name']);
        $this->assertEquals(100, $data[0]['percentage']);

        $this->assertEquals('Match 70', $data[1]['name']);
        $this->assertEquals(70, $data[1]['percentage']);

        $this->assertEquals('Match 50', $data[2]['name']);
        $this->assertEquals(50, $data[2]['percentage']);
    }

    /**
     * Test missing design_path template returns design_path as null/empty without crash.
     */
    public function test_missing_design_path_handled_safely(): void
    {
        Template::create([
            'name' => 'Template Without Design',
            'category' => 'jersey',
            'color' => 'hitam',
            'theme' => 'sporty',
            'image_path' => '/templates/jersey/preview/jersey_elegant_modern.png',
            'design_path' => null,
            'is_active' => true,
        ]);

        $response = $this->postJson(
            route('recommendations.get'),
            [
                'category' => 'jersey',
            ]
        );

        $response->assertStatus(200);
        $data = $response->json('data');

        $found = array_filter($data, fn($item) => $item['name'] === 'Template Without Design');
        $this->assertNotEmpty($found);
        $item = array_values($found)[0];

        // Ensure design_path is null and NOT auto-replaced by image_path
        $this->assertNull($item['design_path']);
        $this->assertNotEquals($item['image_path'], $item['design_path']);
    }
}