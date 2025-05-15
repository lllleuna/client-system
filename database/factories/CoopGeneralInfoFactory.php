<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CoopGeneralInfo;
use App\Models\ExternalUser;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoopGeneralInfo>
 */
class CoopGeneralInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CoopGeneralInfo::class;

    public function definition(): array
    {
        return [
            'externaluser_id' => ExternalUser::where('accreditation_status', 'New')->inRandomOrder()->value('id') 
            ?? ExternalUser::factory(),  // Links to ExternalUser
            'short_name' => $this->faker->companySuffix,
            'cda_registration_date' => $this->faker->date,
            'common_bond_membership' => $this->faker->word,
            'membership_fee' => $this->faker->randomNumber(4),
            'area' => $this->faker->streetName,
            'region' => $this->faker->state,
            'city' => $this->faker->city,
            'province' => $this->faker->state,
            'barangay' => $this->faker->streetName,
            'business_address' => $this->faker->address,
            'email' => $this->faker->unique()->safeEmail,
            'contact_no' => '639' . $this->faker->numberBetween(100000000, 999999999),
        ];
    }
}
