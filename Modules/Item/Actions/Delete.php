<?php

namespace Modules\Item\Actions;

use Modules\Item\Models\Item;

class Delete
{
    public static function run($id): bool
    {
        $item = Item::with('transactions')->findOrFail($id);

        $item->transactions()->delete();

        return $item->delete();
    }
}
