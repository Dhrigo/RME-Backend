<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralAudioAttachment\Http\Controllers\AudioAttachmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('audio-attachments', AudioAttachmentController::class)->parameters(['audio-attachments' => 'audio_attachment']);
});
