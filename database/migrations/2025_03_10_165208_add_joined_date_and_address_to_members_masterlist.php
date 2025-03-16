<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->date('joined_date')->nullable()->after('birthday'); // Add joined_date field
            $table->text('address')->nullable()->after('joined_date');  // Add address field
        });
    }

    public function down()
    {
        Schema::table('members_masterlist', function (Blueprint $table) {
            $table->dropColumn(['joined_date', 'address']);
        });
    }
};
