<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralReference\Http\Controllers\ReferenceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('reference-entries', ReferenceController::class)->parameters(['reference-entries' => 'reference_entry']);
});
