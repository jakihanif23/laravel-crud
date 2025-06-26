<?php

namespace Modules\Sale\Actions;

use Illuminate\Http\Request;
use Modules\Sale\Models\Sale;

class Store
{
    public static function run(Request $request): Sale
    {
        return Sale::create($request->only([
            "tgl",
            "customer_id",
            "subtotal",
        ]));
    }
}
