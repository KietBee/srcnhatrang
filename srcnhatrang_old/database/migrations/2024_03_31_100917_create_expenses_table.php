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
        Schema::create('expenses', function (Blueprint $table) {
            $table->string('expense_id', 50)->primary();
            $table->string('approver_id', 50);
            $table->boolean('type', false);
            $table->string('fund_id', 50)->nullable();
            $table->string('item_id', 50)->nullable();
            $table->decimal('amount', 15, 2);
            $table->text('description');
            $table->timestamps();

            $table->foreign('approver_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('fund_id')
                ->references('fund_id')
                ->on('funds')
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
        Schema::dropIfExists('expenses');
    }
};
