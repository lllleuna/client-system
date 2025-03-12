<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopLoan;
use App\Models\CoopGeneralInfo;
use App\Models\ExternalUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopLoan>
 */
class CoopLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopLoan::class;

    public function definition()
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(),  // Links to CoopInfo
            'financing_institution' => $this->faker->company,
            'acquired_at' => $this->faker->date,
            'amount' => $this->faker->randomFloat(2, 10000, 1000000),
            'utilization' => $this->faker->sentence,
            'remarks' => $this->faker->sentence
        ];
    }
}
