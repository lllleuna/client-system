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
        Schema::table('applications', function (Blueprint $table) {
            $table->string('file_upload');
            $table->string('reference_number')->unique();
        });
    }


    // run the below command in phpmyadmin if this migration did not work

// UPDATE applications 
// SET reference_number = CONCAT('APP-', LPAD(id, 6, '0'))
// WHERE reference_number IS NULL OR reference_number = '';

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('file_upload');
            $table->dropColumn('reference_number');
        });
    }
};
