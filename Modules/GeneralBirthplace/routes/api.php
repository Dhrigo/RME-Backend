<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralBirthplace\Http\Controllers\BirthplaceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('birthplaces', BirthplaceController::class)->parameters(['birthplaces' => 'birthplace']);
});
