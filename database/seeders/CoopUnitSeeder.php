<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CoopUnit;

class CoopUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        CoopUnit::factory()->count(30)->create();
    }
}
