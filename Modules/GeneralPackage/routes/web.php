<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPackage\Http\Controllers\GeneralPackageController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('generalpackages', GeneralPackageController::class)->names('generalpackage');
});
