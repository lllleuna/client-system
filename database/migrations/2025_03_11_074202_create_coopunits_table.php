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
        Schema::create('coopunits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('plate_no')->nullable();
            $table->string('mv_file_no', 15)->nullable();
            $table->string('engine_no')->nullable();
            $table->string('chassis_no')->nullable();
            $table->string('ltfrb_case_no')->nullable();
            $table->date('date_granted')->nullable();
            $table->date('date_of_expiry')->nullable();
            $table->string('origin')->nullable();
            $table->string('via')->nullable();
            $table->string('destination')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coopunits');
    }
};
