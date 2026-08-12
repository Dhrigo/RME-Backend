<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardType\Http\Controllers\GeneralWardTypeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('generalwardtypes', GeneralWardTypeController::class)->names('generalwardtype');
});
