<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->timestamp('contact_no_verified_at')->nullable()->after('email_verified_at');
            $table->timestamp('google_code_verified_at')->nullable()->after('contact_no_verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->dropColumn(['contact_no_verified_at', 'google_code_verified_at']);
        });
    }
};
