<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBirthCertificateLetter\Http\Controllers\BirthCertificateLetterController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('birth-certificate-letters', BirthCertificateLetterController::class)->parameters([
        'birth-certificate-letters' => 'letter',
    ]);
});
