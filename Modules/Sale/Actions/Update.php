<?php

namespace Modules\Sale\Actions;

use Illuminate\Http\Request;
use Modules\Sale\Models\Sale;

class Update
{
    public static function run(Request $request, $id): Sale
    {
        $sale = Sale::findOrFail($id);

        $sale->update($request->only([
            "tgl",
            "customer_id",
            "subtotal",
        ]));

        return $sale;
    }
}
