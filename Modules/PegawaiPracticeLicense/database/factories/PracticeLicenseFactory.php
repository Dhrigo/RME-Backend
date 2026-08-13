<?php

namespace Modules\PegawaiPracticeLicense\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiPracticeLicense\Models\PracticeLicense;

class PracticeLicenseFactory extends Factory
{
    protected $model = PracticeLicense::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['STR', 'SIP']);

        return [
            'employee_id' => Employee::factory(),
            'license_type' => $type,
            'license_number' => fake()->unique()->numerify($type.'-##########'),
            'issued_at' => fake()->dateTimeBetween('-3 years', 'now'),
            'expires_at' => fake()->dateTimeBetween('+1 year', '+5 years'),
            'issuing_authority' => 'Konsil Kedokteran Indonesia',
        ];
    }
}
