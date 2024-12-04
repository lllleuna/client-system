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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('tc_name');
            $table->string('cda_reg_no');
            $table->date('cda_reg_date');
            $table->string('area');
            $table->string('region');
            $table->string('province')->nullable();
            $table->string('city_municipality');
            $table->string('barangay');
            $table->string('address');
            $table->string('status')->default('on-process');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
