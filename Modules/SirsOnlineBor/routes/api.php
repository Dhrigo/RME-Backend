<?php

use Illuminate\Support\Facades\Route;
use Modules\SirsOnlineBor\Http\Controllers\SirsOnlineBorController;

Route::middleware(['auth:sanctum'])->prefix('v1/sirs-online-bor')->group(function () {
    Route::get('tempat-tidur', [SirsOnlineBorController::class, 'index']);
    Route::post('tempat-tidur', [SirsOnlineBorController::class, 'store']);
    Route::get('tempat-tidur/{tempatTidur}', [SirsOnlineBorController::class, 'show']);
    Route::put('tempat-tidur/{tempatTidur}', [SirsOnlineBorController::class, 'update']);
    Route::delete('tempat-tidur/{tempatTidur}', [SirsOnlineBorController::class, 'destroy']);
});
