<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordClinicalNote\Http\Controllers\ClinicalNoteController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('clinical-notes', ClinicalNoteController::class)->only(['index', 'store', 'show']);
});
