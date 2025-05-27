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
        Schema::create('community_resource_wait_lists', function (Blueprint $table) {

            $table->id();

            $table->timestamps();

            $table->foreignId('member_id')->nullable();

            $table->foreignId('resource_id')->nullable();

            $table->integer('no_of_notified_times')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_resource_wait_lists');
    }
};
