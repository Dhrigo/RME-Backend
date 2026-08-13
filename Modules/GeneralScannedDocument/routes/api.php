<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralScannedDocument\Http\Controllers\ScannedDocumentController;

Route::apiResource('scanned_documents', ScannedDocumentController::class)->names('generalscanneddocument.scanned_documents');
