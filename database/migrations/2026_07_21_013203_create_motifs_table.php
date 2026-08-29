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
        Schema::create('motifs', function (Blueprint $table) {

            $table->id();

            // Nama motif
            $table->string('nama');

            // Kategori motif
            $table->string('kategori');

            // Nama file gambar
            $table->string('image_name')->nullable();

            // Lokasi penyimpanan file
            $table->string('path_file');

            // Deskripsi motif
            $table->text('description')->nullable();

            // Status motif
            $table->boolean('is_active')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motifs');
    }
};