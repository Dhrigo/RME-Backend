<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralMaritalStatus\Http\Controllers\MaritalStatusController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('marital_statuses', MaritalStatusController::class);
});
