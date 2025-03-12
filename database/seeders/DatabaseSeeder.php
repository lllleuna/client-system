<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExternalUser;
use App\Models\CoopGeneralInfo;
use App\Models\CoopMembership;
use App\Models\CoopGovernance;
use App\Models\CoopUnit;
use App\Models\CoopFranchise;
use App\Models\CoopFinance;
use App\Models\CoopLoan;
use App\Models\CoopBusiness;
use App\Models\CoopCetos;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        CoopGeneralInfo::factory()->count(2)->create();
        CoopMembership::factory()->count(20)->create();
        CoopGovernance::factory()->count(20)->create();
        CoopUnit::factory()->count(20)->create();
        CoopFranchise::factory()->count(20)->create();
        CoopFinance::factory()->count(10)->create();
        CoopLoan::factory()->count(10)->create();
        CoopBusiness::factory()->count(8)->create();
        CoopCetos::factory()->count(10)->create();
    }
}
