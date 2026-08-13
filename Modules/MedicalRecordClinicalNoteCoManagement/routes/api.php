<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordClinicalNoteCoManagement\Http\Controllers\ClinicalNoteCoManagementController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('clinical-note-co-managements', ClinicalNoteCoManagementController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['clinical-note-co-managements' => 'record']);
});
