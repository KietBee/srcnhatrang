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
        Schema::create('statistics', function (Blueprint $table) {
            $table->string('statistic_id', 50)->primary();
            $table->string('month_id', 50);
            $table->string('year', 50);
            $table->string('statist', 50);
            $table->decimal('total_amount_donation', 15, 2);
            $table->bigInteger('total_item_donation');
            $table->decimal('total_money_expenses', 15, 2);
            $table->bigInteger('total_item_expenses');
            $table->bigInteger('total_pets_rescued');
            $table->bigInteger('total_pest_adoption');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
