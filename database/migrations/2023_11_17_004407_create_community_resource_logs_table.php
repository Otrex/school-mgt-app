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
        Schema::create('community_resource_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('resource_id');
            $table->string('action');
            $table->text('description')->nullable();
            $table->dateTime('check_in')->nullable(); // Check-in timestamp
            $table->dateTime('check_out')->nullable(); // Check-out timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_resource_logs');
    }
};
