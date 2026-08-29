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
        Schema::create('templates', function (Blueprint $table) {

            $table->id();

            // Nama template
            $table->string('name');

            // Atribut Content-Based Filtering
            $table->string('category');
            $table->string('theme');
            $table->string('color');

            // File gambar preview template (kartu rekomendasi)
            $table->string('image_path');

            // File gambar desain transparan template (canvas overlay)
            $table->string('design_path')->nullable();

            // Deskripsi template (opsional)
            $table->text('description')->nullable();

            // Status template
            $table->boolean('is_active')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};