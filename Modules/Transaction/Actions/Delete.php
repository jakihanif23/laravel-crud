<?php

namespace Modules\Transaction\Actions;

use Modules\Transaction\Models\Transaction;

class Delete
{
    public static function run($id): bool
    {
        $transaction = Transaction::findOrFail($id);
        return $transaction->delete();
    }
}
