<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralEducation\Http\Controllers\EducationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('educations', EducationController::class);
});
