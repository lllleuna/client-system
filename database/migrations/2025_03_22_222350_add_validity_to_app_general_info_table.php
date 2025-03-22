<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('app_general_info', function (Blueprint $table) {
            $table->date('validity')->nullable()->after('bir_tax_exemption_no'); // Add after existing 'validity_date' column if it exists
        });
    }

    public function down(): void
    {
        Schema::table('app_general_info', function (Blueprint $table) {
            $table->dropColumn('validity');
        });
    }
};
