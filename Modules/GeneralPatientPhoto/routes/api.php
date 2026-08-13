<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPatientPhoto\Http\Controllers\PatientPhotoController;

Route::apiResource('patient_photos', PatientPhotoController::class)->names('generalpatientphoto.patient_photos');
