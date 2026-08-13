<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientFamily\Http\Controllers\PatientFamilyController;

Route::apiResource('patientfamilies', PatientFamilyController::class)->names('generalpatientfamily.patientfamilies');
