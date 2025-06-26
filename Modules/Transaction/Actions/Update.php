<?php

namespace Modules\Transaction\Actions;

use Illuminate\Http\Request;
use Modules\Transaction\Models\Transaction;

class Update
{
    public static function run(Request $request, $id): Transaction
    {
        $transaction = Transaction::findOrFail($id);

        $data = $request->only([
            'sale_id',
            'item_id',
            'qty',
            'harga'
        ]);

        $data['subtotal'] = $data['qty'] * $data['harga'];

        $transaction->update($data);

        return $transaction;
    }
}
