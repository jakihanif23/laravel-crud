<?php

namespace Modules\Sale\Actions;

use Modules\Sale\Models\Sale;

class Delete
{
    public static function run($id): bool
    {
        $sale = Sale::with('transactions')->findOrFail($id);

        $sale->transactions()->delete();

        return $sale->delete();
    }
}
