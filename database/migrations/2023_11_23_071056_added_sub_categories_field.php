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
        Schema::table('course_categories', function (Blueprint $table) {

            $table->foreignId("parent_category_id")->nullable();

            $table->boolean("is_sub_category")->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_categories', function (Blueprint $table) {

            $table->dropColumn('parent_category_id');

            $table->dropColumn('is_sub_category');

        });
    }
};
