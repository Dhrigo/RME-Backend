<?php

namespace Modules\GeneralNurseWardAssignment\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\GeneralNurseWardAssignment\Models\NurseWardAssignment;
use Modules\GeneralNurse\Models\Nurse;
use Modules\GeneralWard\Models\Ward;

class NurseWardAssignmentFactory extends Factory
{
    protected $model = NurseWardAssignment::class;

    public function definition(): array
    {
        return [
            'nurse_id' => Nurse::factory(),
            'ward_id' => Ward::factory(),
            'shift' => $this->faker->word,
            'assigned_at' => now(),
        ];
    }
}
