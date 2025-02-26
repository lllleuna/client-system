<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'message')) {
                $table->text('message')->nullable()->after('file_upload');
            }
            if (!Schema::hasColumn('applications', 'consent')) {
                $table->boolean('consent')->default(false)->after('message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (Schema::hasColumn('applications', 'message')) {
                $table->dropColumn('message');
            }
            if (Schema::hasColumn('applications', 'consent')) {
                $table->dropColumn('consent');
            }
        });
    }
};

