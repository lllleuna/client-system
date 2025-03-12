<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('coopunits', function (Blueprint $table) {
            $table->string('owned_by')->nullable()->after('externaluser_id');
            $table->string('member_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('coopunits', function (Blueprint $table) {
            $table->dropColumn('owned_by');
            $table->dropColumn('member_id');
        });
    }
};