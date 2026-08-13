<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordHemodialysisLetter\Http\Controllers\HemodialysisLetterController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('hemodialysis-letters', HemodialysisLetterController::class)->parameters([
        'hemodialysis-letters' => 'letter',
    ]);
});
