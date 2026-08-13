<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananAntimicrobialStewardshipGeneralExamination\Http\Controllers\AntimicrobialStewardshipGeneralExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antimicrobial-stewardship-general-examinations', AntimicrobialStewardshipGeneralExaminationController::class)->only(['index', 'store', 'show'])->parameters(['antimicrobial-stewardship-general-examinations' => 'amr_exam']);
});
