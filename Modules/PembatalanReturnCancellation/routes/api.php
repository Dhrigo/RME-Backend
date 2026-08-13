<?php
use Illuminate\Support\Facades\Route;
use Modules\PembatalanReturnCancellation\Http\Controllers\PembatalanReturnCancellationController;
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('return-cancellations', PembatalanReturnCancellationController::class)
        ->parameters(['return-cancellations' => 'return_cancellation']);
});
