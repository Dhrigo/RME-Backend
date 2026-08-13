<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralGuarantorSubspecialty\Http\Controllers\GuarantorSubspecialtyController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('guarantor-subspecialties', GuarantorSubspecialtyController::class);
});
