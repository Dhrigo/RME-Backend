<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralCountry\Http\Controllers\CountryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('countries', CountryController::class);
});
