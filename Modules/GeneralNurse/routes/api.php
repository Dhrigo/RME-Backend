<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralNurse\Http\Controllers\NurseController;

Route::apiResource('nurses', NurseController::class)->names('generalnurse.nurses');
