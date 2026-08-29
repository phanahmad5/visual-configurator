<?php

namespace Tests\Feature;

use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MotifTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public API can retrieve motifs and filter by category.
     */
    public function test_public_api_retrieves_motifs_with_optional_filter(): void
    {
        // 1. Seed motifs in database
        Motif::create([
            'nama' => 'Grid Geometris',
            'kategori' => 'geometris',
            'path_file' => '/motifs/geometris.png',
        ]);

        Motif::create([
            'nama' => 'Red Floral Pattern',
            'kategori' => 'floral',
            'path_file' => '/motifs/floral.png',
        ]);

        // 2. Fetch all motifs
        $response = $this->getJson(route('api.motifs'));
        $response->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);

        $data = $response->json('data');
        $this->assertCount(2, $data);

        // 3. Fetch only geometris motifs
        $filterResponse = $this->getJson(route('api.motifs', ['kategori' => 'geometris']));
        $filterResponse->assertStatus(200);

        $filteredData = $filterResponse->json('data');
        $this->assertCount(1, $filteredData);
        $this->assertEquals('Grid Geometris', $filteredData[0]['nama']);
    }

    /**
     * Test admin role protection on motif routes.
     */
    public function test_non_admin_cannot_access_admin_motif_routes(): void
    {
        // 1. Create a regular user
        $user = User::factory()->create([
            'role' => 'user'
        ]);

        // 2. Access admin index -> should redirect to dashboard
        $response = $this->actingAs($user)->get(route('admin.motifs.index'));
        $response->assertStatus(302)
            ->assertRedirect(route('dashboard'));
    }

    /**
     * Test admin can perform CRUD on motifs.
     */
    public function test_admin_can_perform_motif_crud(): void
    {
        // 1. Create admin user
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        // 2. Access admin list view
        $response = $this->actingAs($admin)->get(route('admin.motifs.index'));
        $response->assertStatus(200);

        // 3. Store new motif using a valid 1x1 transparent PNG decoded from base64 (bypasses GD extension limitation)
        $pngBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';
        $tempPath = tempnam(sys_get_temp_dir(), 'test_png');
        file_put_contents($tempPath, base64_decode($pngBase64));

        $file = new UploadedFile($tempPath, 'custom_pattern.png', 'image/png', null, true);

        $storeResponse = $this->actingAs($admin)->post(route('admin.motifs.store'), [
            'nama' => 'Custom Tribal Pattern',
            'kategori' => 'Pattern',
            'image' => $file,
            'description' => 'A unique custom tribal pattern for sports apparel.',
            'is_active' => '1'
        ]);

        // Clean up the temp file
        if (file_exists($tempPath)) {
            unlink($tempPath);
        }

        $storeResponse->assertSessionHasNoErrors();
        $storeResponse->assertRedirect(route('admin.motifs.index'));
        $this->assertDatabaseHas('motifs', [
            'nama' => 'Custom Tribal Pattern',
            'kategori' => 'Pattern',
            'description' => 'A unique custom tribal pattern for sports apparel.',
            'is_active' => true,
        ]);

        $motif = Motif::where('nama', 'Custom Tribal Pattern')->firstOrFail();

        // 4. Update motif and verify changes
        $updateResponse = $this->actingAs($admin)->put(route('admin.motifs.update', $motif->id), [
            'nama' => 'Updated Custom Tribal Pattern',
            'kategori' => 'Pattern',
            'description' => 'Updated description for the tribal pattern.',
            // Omit is_active to test toggling it off
        ]);

        $updateResponse->assertSessionHasNoErrors();
        $updateResponse->assertRedirect(route('admin.motifs.index'));
        $this->assertDatabaseHas('motifs', [
            'id' => $motif->id,
            'nama' => 'Updated Custom Tribal Pattern',
            'kategori' => 'Pattern',
            'description' => 'Updated description for the tribal pattern.',
            'is_active' => false,
        ]);
    }
}
