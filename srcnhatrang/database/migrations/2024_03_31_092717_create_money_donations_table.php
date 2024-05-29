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
        Schema::create('money_donations', function (Blueprint $table) {
            $table->string('money_donation_id', 50)->primary();
            $table->string('donor_id', 50);
            $table->string('fund_id', 50)->nullable();
            $table->boolean('frequency', false);
            $table->boolean('status', false);
            $table->decimal('amount', 15, 2);
            $table->timestamps();

            $table->foreign('donor_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('fund_id')
                ->references('fund_id')
                ->on('funds')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_donations');
    }
};
