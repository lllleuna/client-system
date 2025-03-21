<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('app_grants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');// Changed to string
            $table->year('entry_year');
            $table->date('date_acquired')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('source')->nullable();
            $table->string('status_remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_grants');
    }
};

