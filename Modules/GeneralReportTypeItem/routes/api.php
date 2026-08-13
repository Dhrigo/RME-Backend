<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralReportTypeItem\Http\Controllers\ReportTypeItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('report-type-items', ReportTypeItemController::class);
});
