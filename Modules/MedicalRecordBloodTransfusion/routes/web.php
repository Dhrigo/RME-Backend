<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBloodTransfusion\Http\Controllers\MedicalRecordBloodTransfusionController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicalrecordbloodtransfusions', MedicalRecordBloodTransfusionController::class)->names('medicalrecordbloodtransfusion');
});
