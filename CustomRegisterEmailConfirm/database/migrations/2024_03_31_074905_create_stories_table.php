<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PharIo\Manifest\Author;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->string('story_id', 50)->primary();
            $table->string('title');
            $table->text('content');
            $table->string('feature_image_url')->nullable();
            $table->string('author_id', 50);
            $table->boolean('is_approved', false);
            $table->string('approver_id', 50)->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->boolean('is_edited', false);
            $table->timestamp('edited_at')->nullable();
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('approver_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
