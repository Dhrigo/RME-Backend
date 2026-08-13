<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientFamilyContact\Http\Controllers\PatientFamilyContactController;

Route::apiResource('patientfamilycontacts', PatientFamilyContactController::class)->names('generalpatientfamilycontact.patientfamilycontacts');
