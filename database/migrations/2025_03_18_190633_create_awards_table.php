<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coopawards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('awarding_body', 255)->nullable();
            $table->string('nature_of_award', 255)->nullable();
            $table->date('date_received')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coopawards');
    }
};
