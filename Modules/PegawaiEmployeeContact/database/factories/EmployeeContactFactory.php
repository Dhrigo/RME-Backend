<?php

namespace Modules\PegawaiEmployeeContact\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PegawaiEmployeeContact\Models\EmployeeContact;

class EmployeeContactFactory extends Factory
{
    protected $model = EmployeeContact::class;

    public function definition(): array
    {
        $type = fake()->randomElement(['telepon_rumah', 'telepon_kantor', 'telepon_seluler', 'faks_rumah', 'faks_kantor', 'email', 'situs_web', 'media_sosial']);

        return [
            'employee_id' => Employee::factory(),
            'contact_type' => $type,
            'value' => $type === 'email' ? fake()->unique()->safeEmail() : fake()->unique()->phoneNumber(),
        ];
    }
}
