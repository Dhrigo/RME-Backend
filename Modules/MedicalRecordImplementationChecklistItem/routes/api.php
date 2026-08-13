<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordImplementationChecklistItem\Http\Controllers\ImplementationChecklistItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('implementation-checklist-items', ImplementationChecklistItemController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['implementation-checklist-items' => 'record']);
});
