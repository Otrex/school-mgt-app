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
        Schema::table('community_resources', function (Blueprint $table) {

            $table->dropColumn('type');

            $table->foreignId('type_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_resources', function (Blueprint $table) {

            $table->dropColumn('type_id');

            $table->string('type');

        });
    }
};
