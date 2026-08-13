<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordHealthCertificate\Http\Controllers\HealthCertificateController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('health-certificates', HealthCertificateController::class)->parameters([
        'health-certificates' => 'certificate',
    ]);
});
