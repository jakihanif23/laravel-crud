<?php

use Illuminate\Support\Facades\Route;
use Modules\Sale\Controllers\SaleController;

Route::prefix('v1')->group(function () {
    Route::apiResource('sales', SaleController::class)->names('sale');
});
