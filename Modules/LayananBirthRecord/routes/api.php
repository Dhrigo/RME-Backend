<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananBirthRecord\Http\Controllers\BirthRecordController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('birth-records', BirthRecordController::class)->only(['index', 'store', 'show', 'update'])->parameters(['birth-records' => 'birth_record']);
});
