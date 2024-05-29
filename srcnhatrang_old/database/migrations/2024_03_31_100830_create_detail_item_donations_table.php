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
        Schema::create('detail_item_donations', function (Blueprint $table) {
            $table->string('item_donation_id', 50);
            $table->string('item_id', 50);
            $table->unsignedBigInteger('amount');
            $table->timestamps();

            $table->primary(['item_donation_id', 'item_id']);
            
            $table->foreign('item_donation_id')
                ->references('item_donation_id')
                ->on('item_donations')
                ->cascadeOnDelete();
            $table->foreign('item_id')
                ->references('item_id')
                ->on('items')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_item_donations');
    }
};
