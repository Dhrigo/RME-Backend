<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardClass\Http\Controllers\WardClassController;

Route::apiResource('ward_classes', WardClassController::class)->names('generalwardclass.ward_classes');
