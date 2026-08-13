<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordImplementationNote\Http\Controllers\ImplementationNoteController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('implementation-notes', ImplementationNoteController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['implementation-notes' => 'record']);
});
