<?php
use Illuminate\Support\Facades\Route;
use Modules\PembatalanFinalResult\Http\Controllers\PembatalanFinalResultController;
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('final-results', PembatalanFinalResultController::class)
        ->parameters(['final-results' => 'final_result']);
});
