<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTriage\Http\Controllers\MedicalRecordTriageController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicalrecordtriages', MedicalRecordTriageController::class)->names('medicalrecordtriage');
});
