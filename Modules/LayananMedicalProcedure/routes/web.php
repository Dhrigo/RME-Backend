<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananMedicalProcedure\Http\Controllers\LayananMedicalProcedureController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('layananmedicalprocedures', LayananMedicalProcedureController::class)->names('layananmedicalprocedure');
});
