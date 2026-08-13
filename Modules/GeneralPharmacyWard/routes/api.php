<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPharmacyWard\Http\Controllers\PharmacyWardController;

Route::apiResource('pharmacy_wards', PharmacyWardController::class)->names('generalpharmacyward.pharmacy_wards');
