<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralEmployeePhoto\Http\Controllers\EmployeePhotoController;

Route::apiResource('employee_photos', EmployeePhotoController::class)->names('generalemployeephoto.employee_photos');
