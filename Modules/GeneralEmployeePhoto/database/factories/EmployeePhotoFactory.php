<?php

namespace Modules\GeneralEmployeePhoto\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralEmployeePhoto\Models\EmployeePhoto;

class EmployeePhotoFactory extends Factory
{
    protected $model = EmployeePhoto::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'file_path' => 'employee-photos/'.fake()->uuid().'.jpg',
            'taken_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
