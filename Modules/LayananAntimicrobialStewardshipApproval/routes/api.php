<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananAntimicrobialStewardshipApproval\Http\Controllers\AntimicrobialStewardshipApprovalController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('antimicrobial-stewardship-approvals', AntimicrobialStewardshipApprovalController::class)->only(['index', 'store', 'show'])->parameters(['antimicrobial-stewardship-approvals' => 'amr_approval']);
});
