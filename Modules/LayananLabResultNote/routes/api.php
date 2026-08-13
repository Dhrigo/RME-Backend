<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabResultNote\Http\Controllers\LabResultNoteController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-result-notes', LabResultNoteController::class)->parameters(['lab-result-notes' => 'lab_note']);
});
