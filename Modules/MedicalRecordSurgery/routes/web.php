<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordSurgery\Http\Controllers\MedicalRecordSurgeryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicalrecordsurgeries', MedicalRecordSurgeryController::class)->names('medicalrecordsurgery');
});
