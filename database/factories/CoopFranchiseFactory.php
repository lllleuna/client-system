<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopGeneralInfo;
use App\Models\CoopFranchise;
use App\Models\ExternalUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopFranchise>
 */
class CoopFranchiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopFranchise::class;

    public function definition()
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(),  // Links to CoopInfo
            'route' => $this->faker->address,
            'cpc_case_number' => $this->faker->uuid,
            'type_of_franchise' => 'One-Type',
            'mode_of_service' => $this->faker->randomElement([
                'PUJ Service', 
                'Mini-Bus Service', 
                'UV Express Service', 
                'PUB Service', 
                'Tricycle/MCH Service', 
                'Tourist Service'
            ]),
            'type_of_unit' => $this->faker->randomElement([
                'Traditional', 
                'Electric', 
                'C1 Euro', 
                'Bus'
            ]),
            'validity' => $this->faker->date,
            'remarks' => $this->faker->sentence
        ];
    }
}
