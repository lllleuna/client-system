<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('governance_list', function (Blueprint $table) {
            $table->string('address', 200)->nullable()->after('end_term'); // Replace 'existing_column' with the actual column after which you want to add this
            $table->boolean('sss_enrolled')->nullable()->after('address');
            $table->boolean('pagibig_enrolled')->nullable()->after('sss_enrolled');
            $table->boolean('philhealth_enrolled')->nullable()->after('pagibig_enrolled');
        });
    }

    public function down()
    {
        Schema::table('governance_list', function (Blueprint $table) {
            $table->dropColumn(['address', 'sss_enrolled', 'pagibig_enrolled', 'philhealth_enrolled']);
        });
    }
};
