<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralDoctor\Http\Controllers\DoctorController;

Route::apiResource('doctors', DoctorController::class)->names('generaldoctor.doctors');
