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
            $table->string('short_name')->nullable();
            $table->date('cda_registration_date')->nullable();
            $table->string('common_bond_membership')->nullable();
            $table->integer('membership_fee')->default(0)->nullable();
            $table->string('area')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('barangay')->nullable();
            $table->string('business_address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('contact_no')->nullable();
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
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('sex')->nullable();
            $table->string('role')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->date('birthday')->nullable();

            $table->timestamps();
        });

        // One to many with coop_info table
        Schema::create('governance_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('externaluser_id')->constrained('externalusers')->onDelete('cascade');
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('sex')->nullable();
            $table->string('role')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();
            $table->date('birthday')->nullable();
            $table->date('start_term')->nullable();
            $table->date('end_term')->nullable();

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
                    $table->string('mode_of_service')->nullable();
                    $table->string('type_of_unit')->nullable();
                    $table->integer('cooperatively_owned')->default(0)->nullable();
                    $table->integer('individually_owned')->default(0)->nullable();
                }
                if ($tableName === 'coop_franchises') {
                    $table->string('route')->nullable();
                    $table->string('cpc_case_number')->nullable();
                    $table->string('type_of_franchise')->nullable();
                    $table->string('mode_of_service')->nullable();
                    $table->string('type_of_unit')->nullable();
                    $table->string('validity')->nullable();
                    $table->string('remarks')->nullable();
                }
                
                if ($tableName === 'coop_finances') {
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
                
                if ($tableName === 'coop_loans') {
                    $table->string('financing_institution')->nullable();
                    $table->date('acquired_at')->nullable();
                    $table->decimal('amount', 15, 2)->nullable();
                    $table->string('utilization')->nullable();
                    $table->string('remarks')->nullable();

                }
                if ($tableName === 'coop_businesses') {
                    $table->enum('type', ['Proposed', 'Existing'])->nullable();
                    $table->string('nature_of_business')->nullable();
                    $table->decimal('starting_capital', 15, 2)->nullable();
                    $table->decimal('capital_to_date', 15, 2)->nullable();
                    $table->integer('years_of_existence')->nullable();
                    $table->string('status')->nullable();
                    $table->string('remarks')->nullable();
                }
                if ($tableName === 'coop_cetos') {
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
