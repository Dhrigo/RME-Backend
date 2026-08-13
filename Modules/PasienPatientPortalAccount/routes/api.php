<?php

use Illuminate\Support\Facades\Route;
use Modules\PasienPatientPortalAccount\Http\Controllers\PatientPortalAccountController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('patient-portal-accounts', PatientPortalAccountController::class)->parameters(['patient-portal-accounts' => 'portal_account']);
});
