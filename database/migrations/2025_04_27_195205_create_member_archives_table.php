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
        Schema::create('member_archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('sex')->nullable();
            $table->string('role')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->date('birthday')->nullable();
            $table->date('joined_date')->nullable(); 
            $table->text('address')->nullable();
            $table->boolean('sss_enrolled')->default(false);
            $table->boolean('pagibig_enrolled')->default(false);
            $table->boolean('philhealth_enrolled')->default(false);
            $table->string('employment_type')->nullable(); 
            $table->decimal('share_capital', 15, 2)->nullable(); 
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_archives');
    }
};
