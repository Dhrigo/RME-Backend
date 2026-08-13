<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordSickLeaveCertificate\Http\Controllers\SickLeaveCertificateController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sick-leave-certificates', SickLeaveCertificateController::class)->parameters([
        'sick-leave-certificates' => 'certificate',
    ]);
});
