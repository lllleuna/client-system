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
        Schema::table('externalusers', function (Blueprint $table) {
            $table->string('pending_contact_no')->nullable();
            $table->string('contact_otp')->nullable();
            $table->timestamp('contact_otp_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->dropColumn('pending_contact_no');
            $table->dropColumn('contact_otp');
            $table->dropColumn('contact_otp_expires_at');
        });
    }
};
