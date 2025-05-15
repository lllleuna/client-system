<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// -------------------------------------
// ------ APPLICATION MANAGEMENT -------
// Temporary Storage when TC sends accreditation or cgs application
// Accessible by OTC
// -------------------------------------

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // General Info Table
        Schema::create('app_general_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->year('entry_year');
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('accreditation_type')->nullable();
            $table->string('cda_registration_no')->nullable();
            $table->date('cda_registration_date')->nullable();
            $table->string('common_bond_membership')->nullable();
            $table->integer('membership_fee')->default(0)->nullable();
            $table->string('area')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('barangay')->nullable();
            $table->string('business_address')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('employer_sss_reg_no')->nullable();
            $table->string('employer_pagibig_reg_no')->nullable();
            $table->string('employer_philhealth_reg_no')->nullable();
            $table->boolean('sss_enrolled')->nullable();
            $table->boolean('pagibig_enrolled')->nullable();
            $table->boolean('philhealth_enrolled')->nullable();
            $table->string('bir_tin')->nullable();
            $table->string('bir_tax_exemption_no')->nullable();
            $table->timestamps();
        });

        // Define all other tables with accreditation_no as a string foreign key
        $tables = [
            'app_units', 'app_franchises',
            'app_governance', 'app_finances', 
            'app_loans', 'app_businesses', 'app_cetos'
        ];

        foreach ($tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                $table->id();
                $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');// Changed to string
                $table->year('entry_year');
                
                if ($tableName === 'app_units') {
                    $table->string('mode_of_service')->nullable();
                    $table->string('type_of_unit')->nullable();
                    $table->integer('cooperatively_owned')->default(0)->nullable();
                    $table->integer('individually_owned')->default(0)->nullable();
                }
                if ($tableName === 'app_franchises') {
                    $table->string('route')->nullable();
                    $table->string('cpc_case_number')->nullable();
                    $table->string('type_of_franchise')->nullable();
                    $table->string('mode_of_service')->nullable();
                    $table->string('type_of_unit')->nullable();
                    $table->string('validity')->nullable();
                    $table->string('remarks')->nullable();
                }
                
                if ($tableName === 'app_governance') {
                    $table->string('role_name', 50)->nullable(); 
                    $table->string('first_name', 100)->nullable();
                    $table->string('middle_name', 100)->nullable();
                    $table->string('last_name', 100)->nullable();
                    $table->string('suffix', 10)->nullable();
                    $table->date('term_start')->nullable();
                    $table->date('term_end')->nullable();
                    $table->string('mobile_number', 12); // Philippine mobile number
                    $table->string('email')->nullable();
                }
                if ($tableName === 'app_finances') {
                     // FINANCIAL ASPECT
                    $table->decimal('current_assets', 15, 2)->nullable();  // Assets in currency (precision of 2 decimal points)
                    $table->decimal('noncurrent_assets', 15, 2)->nullable();
                    $table->decimal('total_assets', 15, 2)->nullable();
                    $table->enum('coop_type', ['Micro', 'Small', 'Medium', 'Large'])->nullable();  // Coop type based on assets
                    $table->decimal('liabilities', 15, 2)->nullable();
                    $table->decimal('members_equity', 15, 2)->nullable();
                    $table->decimal('total_gross_revenues', 15, 2)->nullable();
                    $table->decimal('total_expenses', 15, 2)->nullable();
                    $table->decimal('net_surplus', 15, 2)->nullable();
                    
                    // CAPITALIZATION
                    $table->decimal('initial_auth_capital_share', 15, 2)->nullable();
                    $table->decimal('present_auth_capital_share', 15, 2)->nullable();
                    $table->decimal('subscribed_capital_share', 15, 2)->nullable();
                    $table->decimal('paid_up_capital', 15, 2)->nullable();
                    $table->decimal('capital_build_up_scheme', 15, 2)->nullable();

                    // DISTRIBUTION OF NET SURPLUS
                    $table->decimal('general_reserve_fund', 15, 2)->nullable();
                    $table->decimal('education_training_fund', 15, 2)->nullable();
                    $table->decimal('community_dev_fund', 15, 2)->nullable();
                    $table->decimal('optional_fund', 15, 2)->nullable();
                    $table->decimal('share_capital_interest', 15, 2)->nullable(); // Distribution of Divideds / Interest on share Capital
                    $table->decimal('patronage_refund', 15, 2)->nullable();
                    $table->decimal('others', 15, 2)->nullable();
                    $table->decimal('total', 15, 2)->nullable();
                    $table->decimal('deficit_from_financial_aspect', 15, 2)->nullable();
                }
                
                if ($tableName === 'app_loans') {
                    $table->string('financing_institution')->nullable();
                    $table->date('acquired_at')->nullable();
                    $table->decimal('amount', 15, 2)->nullable();
                    $table->string('utilization')->nullable();
                    $table->string('remarks')->nullable();

                }
                if ($tableName === 'app_businesses') {
                    $table->enum('type', ['Proposed', 'Existing'])->nullable();
                    $table->string('nature_of_business')->nullable();
                    $table->decimal('starting_capital', 15, 2)->nullable();
                    $table->decimal('capital_to_date', 15, 2)->nullable();
                    $table->integer('years_of_existence')->nullable();
                    $table->string('status')->nullable();
                    $table->string('remarks')->nullable();
                }
                if ($tableName === 'app_cetos') {
                    $table->integer('members_with')->nullable();
                    $table->integer('members_without')->nullable();
                    $table->integer('total')->nullable();
        
                }

                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_general_info');

        $tables = [
            'app_units', 'app_franchises',
            'app_governance', 'app_finances', 
            'app_loans', 'app_businesses', 'app_cetos'
        ];

        foreach ($tables as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
};
