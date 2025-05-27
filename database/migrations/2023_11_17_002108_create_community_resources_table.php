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
        Schema::create('community_resources', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('community_center_id')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->integer('max_usage_time')->nullable(); // in seconds
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_resources');
    }
};
