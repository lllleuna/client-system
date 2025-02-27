<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->string('id_type')->after('contact_no');
            $table->string('id_number')->after('id_type');
        });
    }

    public function down()
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->dropColumn(['id_type', 'id_number']);
        });
    }
};
