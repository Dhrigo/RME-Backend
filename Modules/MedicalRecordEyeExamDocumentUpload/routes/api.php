<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEyeExamDocumentUpload\Http\Controllers\EyeExamDocumentUploadController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('eye-exam-document-uploads', EyeExamDocumentUploadController::class)->parameters([
        'eye-exam-document-uploads' => 'upload',
    ]);
});
