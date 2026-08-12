<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAllergy\Http\Controllers\MedicalRecordAllergyController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicalrecordallergies', MedicalRecordAllergyController::class)->names('medicalrecordallergy');
});
