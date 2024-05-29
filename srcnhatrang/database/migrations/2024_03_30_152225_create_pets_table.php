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
        Schema::create('pets', function (Blueprint $table) {
            $table->string('pet_id', 50)->primary();
            $table->string('primary_color_id', 50);
            $table->string('age_id', 50);
            $table->string('size_id', 50);
            $table->string('breed_id', 50);
            $table->string('pet_name');
            $table->boolean('gender', false);
            $table->string('description');
            $table->string('health_status');
            $table->timestamp('rescued_at')->nullable();
            $table->timestamps();

            $table->foreign('primary_color_id')
                ->references('primary_color_id')
                ->on('primary_colors')
                ->cascadeOnDelete();
            $table->foreign('age_id')
                ->references('age_id')
                ->on('ages')
                ->cascadeOnDelete();
            $table->foreign('size_id')
                ->references('size_id')
                ->on('sizes')
                ->cascadeOnDelete();
            $table->foreign('breed_id')
                ->references('breed_id')
                ->on('breeds')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
