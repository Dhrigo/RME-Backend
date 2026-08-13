<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordSocialCondition\Http\Controllers\SocialConditionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('social-conditions', SocialConditionController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['social-conditions' => 'record']);
});
