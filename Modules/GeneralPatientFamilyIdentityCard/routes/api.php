<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientFamilyIdentityCard\Http\Controllers\PatientFamilyIdentityCardController;

Route::apiResource('patientfamilyidentitycards', PatientFamilyIdentityCardController::class)->names('generalpatientfamilyidentitycard.patientfamilyidentitycards');
