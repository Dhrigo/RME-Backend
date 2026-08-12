<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardVisitType\Http\Controllers\GeneralWardVisitTypeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('generalwardvisittypes', GeneralWardVisitTypeController::class)->names('generalwardvisittype');
});
