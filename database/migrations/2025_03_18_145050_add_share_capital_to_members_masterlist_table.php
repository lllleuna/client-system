<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->decimal('share_capital', 15, 2)->nullable()->after('externaluser_id'); // adjust 'after' as needed
        });
    }

    public function down(): void
    {
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->dropColumn('share_capital');
        });
    }
};

