<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ExternalUser;

class ExternalUserFactory extends Factory
{
    protected $model = ExternalUser::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'accreditation_status' => 'New',
            'cda_reg_no' => 'T-' . str_pad($this->faker->unique()->randomNumber(8, true), 8, '0', STR_PAD_LEFT),
            'tc_name' => $this->faker->company,
            'chair_fname' => $this->faker->firstName,
            'chair_mname' => $this->faker->optional()->lastName,
            'chair_lname' => $this->faker->lastName,
            'chair_suffix' => $this->faker->optional()->suffix,
            'contact_no' => '63' . $this->faker->numberBetween(9000000000, 9999999999),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('!Password1234'), // Default password for testing
            'id_type' => $this->faker->randomElement(['Passport', 'Driver\'s License', 'National ID']),
            'id_number' => $this->faker->unique()->regexify('[A-Z0-9]{12}'),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
