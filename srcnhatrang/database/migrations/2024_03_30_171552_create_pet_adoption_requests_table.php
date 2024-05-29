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
            $table->boolean('is_approval', false)->nullable()->default(false);
            $table->string('pet_adoption_id', 50);
            $table->string('requester_id', 50);
            $table->string('approver_id', 50)->nullable();
            $table->text('reason_for_adoption');
            $table->text('notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->foreign('pet_adoption_id')
                ->references('pet_adoption_id')
                ->on('pet_adoptions')
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
