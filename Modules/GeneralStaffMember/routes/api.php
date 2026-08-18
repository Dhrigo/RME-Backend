<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralStaffMember\Http\Controllers\StaffMemberController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('staff-members', StaffMemberController::class)->names('generalstaffmember.staff-members')->parameters(['staff-members' => 'staffMember']);
});
