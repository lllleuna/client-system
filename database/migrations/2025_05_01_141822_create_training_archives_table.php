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
        Schema::create('training_archives', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->nullable();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            
            $table->string('title_of_training');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('no_of_attendees')->nullable();
            $table->decimal('total_fund', 15, 2)->nullable();
            $table->string('remarks')->nullable();
            $table->integer('total_members')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_archives');
    }
};
