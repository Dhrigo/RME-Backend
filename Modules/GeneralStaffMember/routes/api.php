<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralStaffMember\Http\Controllers\StaffMemberController;

Route::apiResource('staff-members', StaffMemberController::class)->names('generalstaffmember.staff-members')->parameters(['staff-members' => 'staffMember']);
