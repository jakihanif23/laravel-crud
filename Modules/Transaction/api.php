<?php

use Illuminate\Support\Facades\Route;
use Modules\Transaction\Controllers\TransactionController;

Route::prefix('v1')->group(function () {
    Route::apiResource('transactions', TransactionController::class)->names('transaction');
});
