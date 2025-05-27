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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->string('title');
            $table->string('category');
            $table->mediumText('summary');
            $table->text('content');
            $table->string('tags')->nullable();
            $table->string('keywords')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_publish')->default(1);
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
