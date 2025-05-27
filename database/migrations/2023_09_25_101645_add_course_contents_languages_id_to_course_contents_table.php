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
        Schema::table('course_contents', function (Blueprint $table) {
            $table->string('course_contents_languages_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_contents', function (Blueprint $table) {
            $table->dropColumn('course_contents_languages_id');
        });
    }
};
