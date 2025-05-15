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
        Schema::create('governance_archives', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->nullable();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('sex')->nullable();
            $table->string('role')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->date('birthday')->nullable();
            $table->date('start_term')->nullable();
            $table->date('end_term')->nullable();
            $table->string('address', 200)->nullable();
            $table->boolean('sss_enrolled')->nullable();
            $table->boolean('pagibig_enrolled')->nullable();
            $table->boolean('philhealth_enrolled')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governance_archives');
    }
};
