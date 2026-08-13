<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordHospitalizationCertificate\Http\Controllers\HospitalizationCertificateController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('hospitalization-certificates', HospitalizationCertificateController::class)->parameters([
        'hospitalization-certificates' => 'certificate',
    ]);
});
