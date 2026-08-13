<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordClinicalNoteVerification\Http\Controllers\ClinicalNoteVerificationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('clinical-note-verifications', ClinicalNoteVerificationController::class)->parameters([
        'clinical-note-verifications' => 'verification',
    ]);
});
