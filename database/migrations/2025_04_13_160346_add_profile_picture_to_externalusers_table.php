<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('contact_no_verified_at');
        });
    }
    
    public function down()
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
        });
    }
    
};
