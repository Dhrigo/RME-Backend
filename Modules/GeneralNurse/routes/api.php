<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralNurse\Http\Controllers\NurseController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nurses', NurseController::class)->names('generalnurse.nurses');
});
