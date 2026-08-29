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
        Schema::create('recommendation_logs', function (Blueprint $table) {

            $table->id();

            // User yang melakukan rekomendasi
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Template yang direkomendasikan
            $table->foreignId('template_id')
                ->constrained('templates')
                ->cascadeOnDelete();

            // Input atribut dari pengguna
            $table->string('category_input')->nullable();
            $table->string('theme_input')->nullable();
            $table->string('color_input')->nullable();

            // Nilai hasil Weighted Attribute Matching
            $table->decimal('score', 4, 2);

            // Peringkat hasil rekomendasi
            $table->unsignedTinyInteger('ranking')->default(1);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommendation_logs');
    }
};