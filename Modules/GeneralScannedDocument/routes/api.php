<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralScannedDocument\Http\Controllers\GeneralScannedDocumentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('scanned-documents', GeneralScannedDocumentController::class)
        ->parameters(['scanned-documents' => 'scannedDocument'])
        ->only(['index', 'store', 'show']);
});
