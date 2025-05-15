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
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->string('employment_type')->nullable()->after('role'); // replace 'some_existing_column' if you want it in a specific position
        });
    }

    public function down(): void
    {
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->dropColumn('employment_type');
        });
    }
};
