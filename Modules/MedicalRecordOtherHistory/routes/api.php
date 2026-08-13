<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordOtherHistory\Http\Controllers\OtherHistoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('other-histories', OtherHistoryController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['other-histories' => 'record']);
});
