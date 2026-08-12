<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralServiceType\Http\Controllers\GeneralServiceTypeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('generalservicetypes', GeneralServiceTypeController::class)->names('generalservicetype');
});
