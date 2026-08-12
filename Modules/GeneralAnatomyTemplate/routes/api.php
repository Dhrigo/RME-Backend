<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralAnatomyTemplate\Http\Controllers\AnatomyTemplateController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('anatomy-templates', AnatomyTemplateController::class);
});
