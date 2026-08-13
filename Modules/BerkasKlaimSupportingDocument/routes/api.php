<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimSupportingDocument\Http\Controllers\BerkasKlaimSupportingDocumentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('supporting-documents', BerkasKlaimSupportingDocumentController::class)
        ->parameters(['supporting-documents' => 'supporting_document']);
});
