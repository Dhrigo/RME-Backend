<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranConsultationAnswer\Http\Controllers\ConsultationAnswerController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('consultationanswers', ConsultationAnswerController::class)->only(['index', 'store', 'show']);
});
