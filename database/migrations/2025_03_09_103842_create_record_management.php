<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// -------------------------------------
// ------- RECORD MANAGEMENT -----------
// Cooperative Tables where they can perform Create, Read, Update, Delete
// Accessible by Clients only
// -------------------------------------

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // BelongsTo ExternalUsers
        Schema::create('coop_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('short_name');
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

        // One to many with coop_info table
        Schema::create('members_masterlist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('sex');
            $table->string('role');
            $table->string('email');
            $table->string('mobile_no');
            $table->date('birthday');

            $table->timestamps();
        });

        // One to many with coop_info table
        Schema::create('governance_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('sex');
            $table->string('role');
            $table->string('email');
            $table->string('mobile_no');
            $table->date('birthday');
            $table->date('start_term');
            $table->date('end_term');

            $table->timestamps();
        });


        // One is to One with coop_info table
        $tables = [
            'coop_units', 'coop_franchises',
             'coop_finances', 
            'coop_loans', 'coop_businesses', 'coop_cetos'
        ];

        foreach ($tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                $table->id();
                $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');

                if ($tableName === 'coop_units') {
                    $table->string('mode_of_service');
                    $table->string('type_of_unit');
                    $table->integer('cooperatively_owned')->default(0);
                    $table->integer('individually_owned')->default(0);
                }
                if ($tableName === 'coop_franchises') {
                    $table->string('route');
                    $table->string('cpc_case_number');
                    $table->string('type_of_franchise');
                    $table->string('mode_of_service');
                    $table->string('type_of_unit');
                    $table->string('validity');
                    $table->string('remarks')->nullable();
                }
                
                if ($tableName === 'coop_finances') {
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
                
                if ($tableName === 'coop_loans') {
                    $table->string('financing_institution');
                    $table->date('acquired_at');
                    $table->decimal('amount', 15, 2);
                    $table->string('utilization');
                    $table->string('remarks');

                }
                if ($tableName === 'coop_businesses') {
                    $table->enum('type', ['Proposed', 'Existing']);
                    $table->string('nature_of_business');
                    $table->decimal('starting_capital', 15, 2);
                    $table->decimal('capital_to_date', 15, 2);
                    $table->integer('years_of_existence');
                    $table->string('status');
                    $table->string('remarks');
                }
                if ($tableName === 'coop_cetos') {
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
        Schema::dropIfExists('coop_info');
        Schema::dropIfExists('members_masterlist');
        Schema::dropIfExists('governance_list');

        $tables = [
            'coop_units', 'coop_franchises',
             'coop_finances', 
            'coop_loans', 'coop_businesses', 'coop_cetos'
        ];

        foreach ($tables as $tableName) {
            Schema::dropIfExists($tableName);
        }

    }
};
