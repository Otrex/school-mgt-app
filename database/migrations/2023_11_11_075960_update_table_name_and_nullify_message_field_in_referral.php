<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('referral', 'referrals');
        Schema::table('referrals', function (Blueprint $table) {
            $table->string('message')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::rename('referrals', 'referral');
        Schema::table('referral', function (Blueprint $table) {
            $table->string('message')->change();
        });
    }
};
