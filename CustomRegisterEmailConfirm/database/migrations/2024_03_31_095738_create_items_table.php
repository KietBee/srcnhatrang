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
        Schema::create('items', function (Blueprint $table) {
            $table->string('item_id', 50)->primary();
            $table->string('item_type_id', 50);
            $table->string('item_name');
            $table->string('item_description');
            $table->bigInteger('quantity');
            $table->timestamps();

            $table->foreign('item_type_id')
                ->references('item_type_id')
                ->on('item_types')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
