<?php

use Illuminate\Support\Facades\Route;
use Modules\Sitb\Http\Controllers\SitbController;

Route::middleware(['auth:sanctum'])->prefix('v1/sitb')->group(function () {
    Route::get('pasien-tb', [SitbController::class, 'index']);
    Route::post('pasien-tb', [SitbController::class, 'store']);
    Route::get('pasien-tb/{pasienTb}', [SitbController::class, 'show']);
    Route::put('pasien-tb/{pasienTb}', [SitbController::class, 'update']);
});
