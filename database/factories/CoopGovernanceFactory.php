<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopGeneralInfo;
use App\Models\CoopGovernance;
use App\Models\ExternalUser;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopGovernance>
 */
class CoopGovernanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopGovernance::class;

    public function definition(): array
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(),  // Links to CoopInfo
            'firstname' => $this->faker->firstName,
            'middlename' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'role' => $this->faker->randomElement([
                'Chairperson', 
                'Vice Chairperson', 
                'Board Member', 
                'Board Secretary',
                'General Manager',
            ]),
            'email' => $this->faker->unique()->safeEmail,
            'mobile_no' => $this->faker->phoneNumber,
            'birthday' => $this->faker->date,
            'start_term' => $startTerm = $this->faker->dateTimeBetween('-5 years', 'now'),
            'end_term' => Carbon::parse($startTerm)->addYears(rand(1, 5)),
        ];
    }
}
