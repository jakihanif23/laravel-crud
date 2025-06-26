<?php

use Illuminate\Support\Facades\Route;
use Modules\Item\Controllers\ItemController;

Route::prefix('v1')->group(function () {
    Route::apiResource('items', ItemController::class)->names('item');
});
