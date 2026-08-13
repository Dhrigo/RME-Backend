<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabMicroscopicResultItem\Http\Controllers\LabMicroscopicResultItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-microscopic-result-items', LabMicroscopicResultItemController::class)->only(['index', 'store', 'show'])->parameters(['lab-microscopic-result-items' => 'microscopic_item']);
});
