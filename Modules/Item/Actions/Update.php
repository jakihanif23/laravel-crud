<?php

namespace Modules\Item\Actions;

use Illuminate\Http\Request;
use Modules\Item\Models\Item;

class Update
{
    public static function run(Request $request, $id): Item
    {
        $item = Item::findOrFail($id);

        $item->update($request->only([
            'nama',
            'kategori',
            'harga',
        ]));

        return $item;
    }
}
