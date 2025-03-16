<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopFinance;
use App\Models\CoopGeneralInfo;
use App\Models\ExternalUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopFinance>
 */
class CoopFinanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopFinance::class;

    public function definition()
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(), // Links to CoopInfo
            'current_assets' => $this->faker->randomFloat(2, 50000, 5000000),
            'noncurrent_assets' => $this->faker->randomFloat(2, 50000, 5000000),
            'total_assets' => $this->faker->randomFloat(2, 100000, 10000000),
            'coop_type' => $this->faker->randomElement(['Micro', 'Small', 'Medium', 'Large']),
            'liabilities' => $this->faker->randomFloat(2, 5000, 500000),
            'members_equity' => $this->faker->randomFloat(2, 10000, 1000000),
            'total_gross_revenues' => $this->faker->randomFloat(2, 50000, 5000000),
            'total_expenses' => $this->faker->randomFloat(2, 20000, 2000000),
            'net_surplus' => $this->faker->randomFloat(2, 5000, 500000),
            'initial_auth_capital_share' => $this->faker->randomFloat(2, 10000, 500000),
            'present_auth_capital_share' => $this->faker->randomFloat(2, 20000, 1000000),
            'subscribed_capital_share' => $this->faker->randomFloat(2, 5000, 500000),
            'paid_up_capital' => $this->faker->randomFloat(2, 10000, 500000),
            'capital_build_up_scheme' => $this->faker->randomFloat(2, 5000, 200000),
            'general_reserve_fund' => $this->faker->randomFloat(2, 1000, 50000),
            'education_training_fund' => $this->faker->randomFloat(2, 500, 20000),
            'community_dev_fund' => $this->faker->randomFloat(2, 500, 20000),
            'optional_fund' => $this->faker->randomFloat(2, 500, 20000),
            'share_capital_interest' => $this->faker->randomFloat(2, 500, 20000),
            'patronage_refund' => $this->faker->randomFloat(2, 500, 20000),
            'others' => $this->faker->randomFloat(2, 500, 20000),
            'total' => $this->faker->randomFloat(2, 5000, 100000),
            'deficit_from_financial_aspect' => $this->faker->randomFloat(2, 500, 10000),
        ];
    }
}
