<?php
// leuna notes
// failed to migrate
// manually added to my database

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->renameColumn('accreditation_no', 'cda_reg_no');
            $table->string('accreditation_status')->after('id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('externalusers', function (Blueprint $table) {
            $table->renameColumn('cda_reg_no', 'accreditation_no');
            $table->dropColumn('accreditation_status');
        });
    }
};
