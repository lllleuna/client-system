<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileUploadToCoopTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coop_grants_and_donations', function (Blueprint $table) {
            $table->string('file_upload')->nullable()->after('status_remarks');
        });

        Schema::table('coop_loans', function (Blueprint $table) {
            $table->string('file_upload')->nullable()->after('remarks');
        });

        Schema::table('coop_businesses', function (Blueprint $table) {
            $table->string('file_upload')->nullable()->after('remarks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coop_grants_and_donations', function (Blueprint $table) {
            $table->dropColumn('file_upload');
        });

        Schema::table('coop_loans', function (Blueprint $table) {
            $table->dropColumn('file_upload');
        });

        Schema::table('coop_businesses', function (Blueprint $table) {
            $table->dropColumn('file_upload');
        });
    }
}
