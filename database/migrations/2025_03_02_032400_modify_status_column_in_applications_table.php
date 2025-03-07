<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->enum('status', ['new', 'evaluated', 'approved', 'rejected', 'waiting', 'needs_info'])
                ->default('new')
                ->change();
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('status')->default('on-process')->change();
        });
    }
};
 
