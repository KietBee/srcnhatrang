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
        Schema::create('story_categories', function (Blueprint $table) {
            $table->string('story_id', 50);
            $table->string('category_id', 50);
            $table->timestamps();
            
            $table->primary(['story_id', 'category_id']);
            
            $table->foreign('story_id')
                ->references('story_id')
                ->on('stories')
                ->cascadeOnDelete();
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_categories');
    }
};
