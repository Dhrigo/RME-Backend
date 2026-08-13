<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranConsultation\Http\Controllers\ConsultationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('consultations', ConsultationController::class)->only(['index', 'store', 'show']);
});
