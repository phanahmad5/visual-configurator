<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('designs', function (Blueprint $table) {

    $table->id();

    // Relasi ke user
    $table->foreignId('user_id')
          ->constrained()
          ->cascadeOnDelete();

    // Nama desain
    $table->string('name');

    // Jenis produk
    $table->enum('product_type', ['tshirt', 'jersey'])
          ->default('tshirt');

    // Warna produk
    $table->string('shirt_color')
          ->default('white');

    // Data Fabric.js untuk Front dan Back
    $table->json('canvas_data')
          ->nullable();

    // File hasil export
    $table->string('export_image')
          ->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};