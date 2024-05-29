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
        Schema::create('pet_adoption_requests', function (Blueprint $table) {
            $table->string('pet_adoption_request_id', 50)->primary();
            $table->boolean('is_approval', false);
            $table->string('pet_id', 50);
            $table->string('requester_id', 50);
            $table->string('approver_id', 50);
            $table->text('reason_for_adoption');
            $table->text('notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('pet_id')
                ->references('pet_id')
                ->on('pets')
                ->cascadeOnDelete();
            $table->foreign('requester_id')
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
        Schema::dropIfExists('pet_adoption_requests');
    }
};
