<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralVideoAttachment\Http\Controllers\VideoAttachmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('video-attachments', VideoAttachmentController::class)->parameters(['video-attachments' => 'video_attachment']);
});
