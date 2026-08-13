<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralRadiologyWard\Http\Controllers\RadiologyWardController;

Route::apiResource('radiology_wards', RadiologyWardController::class)->names('generalradiologyward.radiology_wards');
