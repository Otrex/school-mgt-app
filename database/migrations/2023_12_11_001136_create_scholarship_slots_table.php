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
        Schema::create('scholarship_slots', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('patron_id')->nullable();
            $table->foreignId('beneficiary_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->float('amount_left')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_slots');
    }
};