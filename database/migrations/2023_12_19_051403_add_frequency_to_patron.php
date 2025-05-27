<?php

use App\Enums\PaymentFrequency;
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
        Schema::table('patrons', function (Blueprint $table) {
            //
            $table->string('payment_frequency')->default(PaymentFrequency::ONE_TIME->value);
            $table->timestamp('next_due_date')->nullable();
            $table->string('payment_authorization_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patrons', function (Blueprint $table) {
            $table->dropColumn('payment_authorization_code');
            $table->dropColumn('payment_frequency');
            $table->dropColumn('next_due_date');
        });
    }
};