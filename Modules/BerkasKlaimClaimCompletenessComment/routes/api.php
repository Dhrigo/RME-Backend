<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimClaimCompletenessComment\Http\Controllers\BerkasKlaimClaimCompletenessCommentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('claim-completeness-comments', BerkasKlaimClaimCompletenessCommentController::class)
        ->parameters(['claim-completeness-comments' => 'claim_completeness_comment']);
});
