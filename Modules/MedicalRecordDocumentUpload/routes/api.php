<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDocumentUpload\Http\Controllers\DocumentUploadController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('document-uploads', DocumentUploadController::class)->parameters([
        'document-uploads' => 'upload',
    ]);
});
