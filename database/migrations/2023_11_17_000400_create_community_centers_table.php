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
        Schema::create('community_centers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('manager_id')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->foreignId('local_government_id')->nullable();
            $table->foreignId('town_id')->nullable();
            $table->string('address')->nullable();
            $table->string('name')->nullable();
            $table->boolean('is_active')->nullable();
            $table->time('opening_hours')->nullable();
            $table->time('closing_hours')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_centers');
    }
};
