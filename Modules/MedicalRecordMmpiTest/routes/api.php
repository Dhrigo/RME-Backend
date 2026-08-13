<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordMmpiTest\Http\Controllers\MmpiTestController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('mmpi-tests', MmpiTestController::class)->parameters([
        'mmpi-tests' => 'test',
    ]);
});
