<?php
use Illuminate\Support\Facades\Route;
use Modules\PembatalanDocumentCancellation\Http\Controllers\PembatalanDocumentCancellationController;
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('document-cancellations', PembatalanDocumentCancellationController::class)
        ->parameters(['document-cancellations' => 'document_cancellation']);
});
