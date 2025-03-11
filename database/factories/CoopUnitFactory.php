<?php

namespace Database\Factories;

use App\Models\CoopUnit;
use App\Models\ExternalUser;
use App\Models\CoopMembership;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoopUnitFactory extends Factory
{
    protected $model = CoopUnit::class;

    public function definition()
    {
        // Select a random existing ExternalUser
        $externalUser = ExternalUser::inRandomOrder()->first();

        // Ensure an external user exists before proceeding
        if (!$externalUser) {
            return [];
        }

        // Randomly decide ownership type
        $ownedBy = $this->faker->randomElement(['coop', 'individual']);

        // If owned by individual, get a member from the same external user
        $memberId = null;
        if ($ownedBy === 'individual') {
            $memberId = CoopMembership::where('externaluser_id', $externalUser->id)->inRandomOrder()->value('id');
        }

        // Ensure uniqueness for `plate_no`, `chassis_no`, and `ltfrb_case_no` per `externaluser_id`
        do {
            $plateNo = strtoupper($this->faker->bothify('###-####'));
        } while (CoopUnit::where('externaluser_id', $externalUser->id)->where('plate_no', $plateNo)->exists());

        do {
            $chassisNo = strtoupper($this->faker->bothify('CHS#######'));
        } while (CoopUnit::where('externaluser_id', $externalUser->id)->where('chassis_no', $chassisNo)->exists());

        do {
            $ltfrbCaseNo = strtoupper($this->faker->bothify('LTFRB#######'));
        } while (CoopUnit::where('externaluser_id', $externalUser->id)->where('ltfrb_case_no', $ltfrbCaseNo)->exists());

        return [
            'externaluser_id' => $externalUser->id,
            'owned_by' => $ownedBy,
            'member_id' => $memberId,
            'type' => $this->faker->randomElement([
                "Bus", "COASTER (TOURIST)", "SEDAN (TOURIST)", "VAN (TOURIST)", "MPUV C4 ELECTRIC",
                "MPUV C4 MODERNIZED", "MPUV C3 SOLAR", "MPUV C3 EURO", "MPUV C3 ELECTRIC",
                "MPUV C1 SOLAR", "SHUTTLE", "MCH", "TRUCK", "TAXI", "TOURIST",
                "PUJ TRADITIONAL", "MULTICAB", "FILCAB", "UV EXPRESS TRADITIONAL"
            ]),
            'plate_no' => $plateNo,
            'mv_file_no' => $this->faker->numerify('###############'), // 15-digit MV number
            'engine_no' => strtoupper($this->faker->bothify('ENG#######')),
            'chassis_no' => $chassisNo,
            'ltfrb_case_no' => $ltfrbCaseNo,
            'date_granted' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'date_of_expiry' => $this->faker->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
            'origin' => $this->faker->randomElement([
                "Manila", "Quezon City", "Malabon", "Makati", "Taguig", "Pasig", "Pateros", "Cavite", "Antipolo"
            ]),
            'via' => $this->faker->randomElement([
                "NLEX Harbor Link", "Service Rd", "Jose P. Rizal Avenue", "Marikina–Infanta Highway",
                "Magsaysay Boulevard", "Commonwealth Avenue", "Quirino Highway"
            ]),
            'destination' => $this->faker->randomElement([
                "Manila", "Quezon City", "Malabon", "Makati", "Taguig", "Pasig", "Pateros", "Cavite", "Antipolo"
            ]),
        ];
    }
}
