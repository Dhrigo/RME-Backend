<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPackageTariffDistributionItem\Http\Controllers\PackageTariffDistributionItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('package-tariff-distribution-items', PackageTariffDistributionItemController::class)
        ->parameters(['package-tariff-distribution-items' => 'distribution_item']);
});
