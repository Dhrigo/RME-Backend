<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralGuarantorParticipantType\Http\Controllers\GuarantorParticipantTypeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('guarantor-participant-types', GuarantorParticipantTypeController::class);
});
