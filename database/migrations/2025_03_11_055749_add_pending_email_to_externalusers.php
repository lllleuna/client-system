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
            $table->string('pending_email')->nullable()->after('email');
            $table->string('email_verification_token')->nullable()->after('pending_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->dropColumn('pending_email');
            $table->dropColumn('email_verification_token');
        });
    }
};
