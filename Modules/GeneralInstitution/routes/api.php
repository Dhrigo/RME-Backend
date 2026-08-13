<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralInstitution\Http\Controllers\InstitutionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('institutions', InstitutionController::class);
});
