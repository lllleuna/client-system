<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopCetos;
use App\Models\CoopGeneralInfo;
use App\Models\ExternalUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopCetos>
 */
class CoopCetosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopCetos::class;

    public function definition()
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(),  // Links to CoopInfo
            'members_with' => $this->faker->numberBetween(1, 20),
            'members_without' => $this->faker->numberBetween(1, 5),
            'total' => function (array $attributes) {
                return $attributes['members_with'] + $attributes['members_without'];
            }
        ];
    }
}
