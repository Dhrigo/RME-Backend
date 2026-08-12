<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordVitalSign\Http\Controllers\MedicalRecordVitalSignController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicalrecordvitalsigns', MedicalRecordVitalSignController::class)->names('medicalrecordvitalsign');
});
