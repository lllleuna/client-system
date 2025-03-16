<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->boolean('sss_enrolled')->default(false);
            $table->boolean('pagibig_enrolled')->default(false);
            $table->boolean('philhealth_enrolled')->default(false);
        });
    }

    public function down()
    {
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->dropColumn(['sss_enrolled', 'pagibig_enrolled', 'philhealth_enrolled']);
        });
    }
};
