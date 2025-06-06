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
        Schema::create('course_series', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->integer('serial_no');
            $table->string('title');
            $table->mediumText('summary');
            $table->text('content');
            $table->mediumText('media_url')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_series');
    }
};
