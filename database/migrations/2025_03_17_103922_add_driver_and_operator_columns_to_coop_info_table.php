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
            $table->integer('driver_probationary_male')->nullable();
            $table->integer('driver_probationary_female')->nullable();
            $table->integer('driver_regular_male')->nullable();
            $table->integer('driver_regular_female')->nullable();

            $table->integer('operator_probationary_male')->nullable();
            $table->integer('operator_probationary_female')->nullable();
            $table->integer('operator_regular_male')->nullable();
            $table->integer('operator_regular_female')->nullable();

            $table->integer('allied_probationary_male')->nullable();
            $table->integer('allied_probationary_female')->nullable();
            $table->integer('allied_regular_male')->nullable();
            $table->integer('allied_regular_female')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coop_info', function (Blueprint $table) {
            $table->dropColumn([
                'driver_probationary_male',
                'driver_probationary_female',
                'driver_regular_male',
                'driver_regular_female',

                'operator_probationary_male',
                'operator_probationary_female',
                'operator_regular_male',
                'operator_regular_female',

                'allied_probationary_male',
                'allied_probationary_female',
                'allied_regular_male',
                'allied_regular_female'
            ]);
        });
    }
};
