<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopGeneralInfo;
use App\Models\CoopUnit;
use App\Models\ExternalUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopUnit>
 */
class CoopUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopUnit::class;

    public function definition()
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(),  // Links to CoopInfo
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
            'cooperatively_owned' => $this->faker->numberBetween(1, 5),
            'individually_owned' => $this->faker->numberBetween(1, 5)
        ];
    }
}
