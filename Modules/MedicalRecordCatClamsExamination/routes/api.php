<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordCatClamsExamination\Http\Controllers\CatClamsExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('cat-clams-examinations', CatClamsExaminationController::class)
        ->parameters(['cat-clams-examinations' => 'record']);
});
