<?php

namespace Modules\Transaction\Actions;

use Illuminate\Http\Request;
use Modules\Transaction\Models\Transaction;

class Store
{
    public static function run(Request $request): Transaction
    {
        $data = $request->only([
            'sale_id',
            'item_id',
            'qty',
            'harga'
        ]);

        $data['subtotal'] = $data['qty'] * $data['harga'];

        return Transaction::create($data);
    }
}
