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
        Schema::table('communities', function (Blueprint $table) {
            $table->foreignId('state_id')->nullable()->after('state');
            $table->foreignId('local_government_id')->nullable()->after('local_government');
            $table->foreignId('town_id')->nullable()->after('town');
            $table->foreignId('tertiary_institution_id')->nullable()->after('town');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communities', function (Blueprint $table) {
            //
        });
    }
};
