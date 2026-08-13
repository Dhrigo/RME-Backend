<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPackageTariffDistribution\Http\Controllers\PackageTariffDistributionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('package-tariff-distributions', PackageTariffDistributionController::class)
        ->parameters(['package-tariff-distributions' => 'package_tariff_distribution']);
});
