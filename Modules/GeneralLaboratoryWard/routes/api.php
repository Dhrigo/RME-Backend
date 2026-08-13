<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralLaboratoryWard\Http\Controllers\LaboratoryWardController;

Route::apiResource('laboratory_wards', LaboratoryWardController::class)->names('generallaboratoryward.laboratory_wards');
