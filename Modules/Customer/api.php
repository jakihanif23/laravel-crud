<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Controllers\CustomerController;

Route::prefix('v1')->group(function () {
    Route::apiResource('customers', CustomerController::class)->names('customer');
});
