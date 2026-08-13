<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralGuarantorWardAccess\Http\Controllers\GuarantorWardAccessController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('guarantor-ward-accesses', GuarantorWardAccessController::class);
});
