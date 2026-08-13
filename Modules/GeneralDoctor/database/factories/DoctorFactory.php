<?php

namespace Modules\GeneralDoctor\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralEmployee\Models\Employee;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'specialization' => $this->faker->word,
            'sip_number' => $this->faker->numerify('SIP-##########'),
            'is_active' => true,
        ];
    }
}
