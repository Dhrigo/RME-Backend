<?php
use Illuminate\Support\Facades\Route;
use Modules\PembatalanMedicalRecordCancellation\Http\Controllers\PembatalanMedicalRecordCancellationController;
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('medical-record-cancellations', PembatalanMedicalRecordCancellationController::class)
        ->parameters(['medical-record-cancellations' => 'medical_record_cancellation']);
});
