<?php

namespace Modules\Item\Actions;

use Illuminate\Http\Request;
use Modules\Item\Models\Item;

class Store
{
    public static function run(Request $request): Item
    {
        return Item::create($request->only(['nama', 'kategori', 'harga']));
    }
}
