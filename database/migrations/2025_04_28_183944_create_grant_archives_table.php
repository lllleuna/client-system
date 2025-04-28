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
        Schema::create('grant_archives', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->nullable();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');

            $table->date('date_acquired')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('source')->nullable();
            $table->string('status_remarks')->nullable();
            $table->string('file_upload')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grant_archives');
    }
};
