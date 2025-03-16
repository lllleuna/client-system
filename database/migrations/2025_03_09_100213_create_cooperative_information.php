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
            $table->string('name');
            $table->string('short_name');
            $table->string('accreditation_type');
            $table->string('cda_registration_no');
            $table->date('cda_registration_date');
            $table->string('common_bond_membership');
            $table->integer('membership_fee')->default(0);
            $table->string('area');
            $table->string('region');
            $table->string('city');
            $table->string('province');
            $table->string('barangay');
            $table->string('business_address');
            $table->string('email')->unique();
            $table->string('contact_no');
            $table->string('employer_sss_reg_no')->nullable();
            $table->string('employer_pagibig_reg_no')->nullable();
            $table->string('employer_philhealth_reg_no')->nullable();
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
                    $table->string('mode_of_service');
                    $table->string('type_of_unit');
                    $table->integer('cooperatively_owned')->default(0);
                    $table->integer('individually_owned')->default(0);
                }
                if ($tableName === 'app_franchises') {
                    $table->string('route');
                    $table->string('cpc_case_number');
                    $table->string('type_of_franchise');
                    $table->string('mode_of_service');
                    $table->string('type_of_unit');
                    $table->string('validity');
                    $table->string('remarks')->nullable();
                }
                
                if ($tableName === 'app_governance') {
                    $table->string('role_name', 50); 
                    $table->string('first_name', 100);
                    $table->string('middle_name', 100)->nullable();
                    $table->string('last_name', 100);
                    $table->string('suffix', 10)->nullable();
                    $table->date('term_start');
                    $table->date('term_end')->nullable();
                    $table->string('mobile_number', 11); // Philippine mobile number
                    $table->string('email')->unique();
                }
                if ($tableName === 'app_finances') {
                     // FINANCIAL ASPECT
                    $table->decimal('current_assets', 15, 2);  // Assets in currency (precision of 2 decimal points)
                    $table->decimal('noncurrent_assets', 15, 2);
                    $table->decimal('total_assets', 15, 2);
                    $table->enum('coop_type', ['Micro', 'Small', 'Medium', 'Large']);  // Coop type based on assets
                    $table->decimal('liabilities', 15, 2);
                    $table->decimal('members_equity', 15, 2);
                    $table->decimal('total_gross_revenues', 15, 2);
                    $table->decimal('total_expenses', 15, 2);
                    $table->decimal('net_surplus', 15, 2);
                    
                    // CAPITALIZATION
                    $table->decimal('initial_auth_capital_share', 15, 2);
                    $table->decimal('present_auth_capital_share', 15, 2);
                    $table->decimal('subscribed_capital_share', 15, 2);
                    $table->decimal('paid_up_capital', 15, 2);
                    $table->decimal('capital_build_up_scheme', 15, 2);

                    // DISTRIBUTION OF NET SURPLUS
                    $table->decimal('general_reserve_fund', 15, 2);
                    $table->decimal('education_training_fund', 15, 2);
                    $table->decimal('community_dev_fund', 15, 2);
                    $table->decimal('optional_fund', 15, 2);
                    $table->decimal('share_capital_interest', 15, 2); // Distribution of Divideds / Interest on share Capital
                    $table->decimal('patronage_refund', 15, 2);
                    $table->decimal('others', 15, 2);
                    $table->decimal('total', 15, 2);
                    $table->decimal('deficit_from_financial_aspect', 15, 2);
                }
                
                if ($tableName === 'app_loans') {
                    $table->string('financing_institution');
                    $table->date('acquired_at');
                    $table->decimal('amount', 15, 2);
                    $table->string('utilization');
                    $table->string('remarks');

                }
                if ($tableName === 'app_businesses') {
                    $table->enum('type', ['Proposed', 'Existing']);
                    $table->string('nature_of_business');
                    $table->decimal('starting_capital', 15, 2);
                    $table->decimal('capital_to_date', 15, 2);
                    $table->integer('years_of_existence');
                    $table->string('status');
                    $table->string('remarks');
                }
                if ($tableName === 'app_cetos') {
                    $table->integer('members_with');
                    $table->integer('members_without');
                    $table->integer('total');
        
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
