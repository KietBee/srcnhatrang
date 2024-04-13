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
        Schema::create('item_donations', function (Blueprint $table) {
            $table->string('item_donation_id', 50)->primary();
            $table->string('donor_id', 50);
            $table->string('approver_id', 50);
            $table->timestamp('approved_at')->nullable();
            $table->string('delivery_method_id', 50);
            $table->boolean('status', false);
            $table->unsignedBigInteger('quantity');
            $table->timestamps();

            $table->foreign('delivery_method_id')
                ->references('delivery_method_id')
                ->on('delivery_methods')
                ->cascadeOnDelete();
            $table->foreign('donor_id')
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
        Schema::dropIfExists('item_donations');
    }
};
