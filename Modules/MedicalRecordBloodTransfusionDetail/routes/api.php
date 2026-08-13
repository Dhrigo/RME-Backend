<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBloodTransfusionDetail\Http\Controllers\BloodTransfusionDetailController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('blood-transfusion-details', BloodTransfusionDetailController::class)->parameters([
        'blood-transfusion-details' => 'detail',
    ]);
});
