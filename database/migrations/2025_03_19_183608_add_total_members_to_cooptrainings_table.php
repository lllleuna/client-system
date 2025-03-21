<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cooptrainings', function (Blueprint $table) {
            $table->integer('total_members')->nullable()->after('no_of_attendees');
        });
    }

    public function down(): void
    {
        Schema::table('cooptrainings', function (Blueprint $table) {
            $table->dropColumn('total_members');
        });
    }
};

