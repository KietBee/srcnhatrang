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
        Schema::create('pet_adoptions', function (Blueprint $table) {
            $table->string('pet_adoption_id', 50)->primary();
            $table->string('pet_id', 50);
            $table->string('title');
            $table->text('description');
            $table->string('created_by', 50);
            $table->timestamps();

            $table->foreign('pet_id')
                ->references('pet_id')
                ->on('pets')
                ->cascadeOnDelete();
            $table->foreign('created_by')
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
        Schema::dropIfExists('pet_adoptions');
    }
};
