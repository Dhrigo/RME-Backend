<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordMaternalPregnancyHistory\Http\Controllers\MaternalPregnancyHistoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('maternal-pregnancy-histories', MaternalPregnancyHistoryController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['maternal-pregnancy-histories' => 'record']);
});
