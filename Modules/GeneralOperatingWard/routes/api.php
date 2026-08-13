<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralOperatingWard\Http\Controllers\OperatingWardController;

Route::apiResource('operating_wards', OperatingWardController::class)->names('generaloperatingward.operating_wards');
