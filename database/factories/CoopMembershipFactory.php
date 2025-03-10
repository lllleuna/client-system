<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopGeneralInfo;
use App\Models\CoopMembership;
use App\Models\ExternalUser;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopMembership>
 */
class CoopMembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopMembership::class;

    public function definition(): array
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(),  // Links to CoopInfo
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->lastName,
            'lastname' => $this->faker->lastName,
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'role' => $this->faker->randomElement(['Driver', 'Operator', 'Allied Workers', 'Others']),
            'email' => $this->faker->unique()->safeEmail,
            'mobile_no' => $this->faker->phoneNumber,
            'birthday' => $this->faker->date
        ];
    }
}
