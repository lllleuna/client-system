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
            $table->boolean('two_factor_enabled')->default(false)->after('contact_no_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->dropColumn('two_factor_enabled');
        });
    }
};
