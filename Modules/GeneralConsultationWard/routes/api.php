<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralConsultationWard\Http\Controllers\ConsultationWardController;

Route::apiResource('consultation_wards', ConsultationWardController::class)->names('generalconsultationward.consultation_wards');
