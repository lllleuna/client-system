<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopBusiness;
use App\Models\CoopGeneralInfo;
use App\Models\ExternalUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopBusiness>
 */
class CoopBusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopBusiness::class;

    public function definition()
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(), 
            'type' => $this->faker->randomElement(['Proposed', 'Existing']),
            'nature_of_business' => $this->faker->word,
            'starting_capital' => $this->faker->randomFloat(2, 10000, 500000),
            'capital_to_date' => $this->faker->randomFloat(2, 50000, 5000000),
            'years_of_existence' => $this->faker->numberBetween(1, 40),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'On-going Operations']),
            'remarks' => $this->faker->sentence
        ];
    }
}
