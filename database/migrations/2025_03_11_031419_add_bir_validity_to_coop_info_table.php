<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('coop_info', function (Blueprint $table) {
            $table->date('bir_validity')->nullable()->after('bir_tax_exemption_no'); // Replace existing_column_name with the column after which you want to place bir_validity
        });
    }

    public function down()
    {
        Schema::table('coop_info', function (Blueprint $table) {
            $table->dropColumn('bir_validity');
        });
    }
};
