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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('amount')->default(0);
            $table->string('status')->nullable();
            $table->string('ref')->nullable();
            $table->string('type')->nullable();
            $table->string('source')->nullable();
            $table->string('metadata')->nullable();
            $table->foreignId("member_id")->nullable();
            $table->foreignId("parent_id")->nullable();
            $table->boolean('is_recurring')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};