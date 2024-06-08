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
            $table->string('month', 50);
            $table->string('year', 50);
            $table->string('fund_id', 50);
            $table->string('statist', 50);
            $table->decimal('total_amount_donation', 15, 2);
            $table->decimal('total_money_expenses', 15, 2);
            $table->timestamps();

            $table->foreign('fund_id')
                ->references('fund_id')
                ->on('funds')
                ->cascadeOnDelete();

            $table->foreign('statist')
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
        Schema::dropIfExists('statistics');
    }
};
