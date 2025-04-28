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
        Schema::create('business_archives', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->nullable();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            
            $table->enum('type', ['Proposed', 'Existing'])->nullable();
            $table->string('nature_of_business')->nullable();
            $table->decimal('starting_capital', 15, 2)->nullable();
            $table->decimal('capital_to_date', 15, 2)->nullable();
            $table->integer('years_of_existence')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('business_archives');
    }
};
