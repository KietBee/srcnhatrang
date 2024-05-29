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
        Schema::create('pet_images', function (Blueprint $table) {
            $table->string('pet_image_id', 50)->primary();
            $table->string('pet_id', 50);
            $table->string('pet_image');
            $table->timestamps();

            $table->foreign('pet_id')
                ->references('pet_id')
                ->on('pets')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_images');
    }
};
