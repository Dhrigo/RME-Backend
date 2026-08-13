<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralAdministration\Http\Controllers\AdministrationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('administrations', AdministrationController::class);
});
