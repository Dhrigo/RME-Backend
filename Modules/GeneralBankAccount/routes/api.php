<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralBankAccount\Http\Controllers\BankAccountController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('bank-accounts', BankAccountController::class);
});
