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
        Schema::table('coop_info', function (Blueprint $table) {
            $table->integer('total_sss_enrolled')->default(0);
            $table->integer('total_pagibig_enrolled')->default(0);
            $table->integer('total_philhealth_enrolled')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coop_info', function (Blueprint $table) {
            $table->dropColumn(['total_sss_enrolled', 'total_pagibig_enrolled', 'total_philhealth_enrolled']);
        });
    }
};
