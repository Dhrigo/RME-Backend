<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralMedicalDepartment\Http\Controllers\GeneralMedicalDepartmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('generalmedicaldepartments', GeneralMedicalDepartmentController::class)->names('generalmedicaldepartment');
});
