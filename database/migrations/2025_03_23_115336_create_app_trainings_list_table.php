<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_trainings_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->year('entry_year');
            $table->string('title_of_training', 255)->nullable();
            $table->integer('no_of_attendees')->default(0);
            $table->decimal('total_fund', 12, 2)->default(0);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('app_trainings_list');
    }
};
