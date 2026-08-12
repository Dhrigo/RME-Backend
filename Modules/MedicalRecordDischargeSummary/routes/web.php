<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDischargeSummary\Http\Controllers\MedicalRecordDischargeSummaryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('medicalrecorddischargesummaries', MedicalRecordDischargeSummaryController::class)->names('medicalrecorddischargesummary');
});
