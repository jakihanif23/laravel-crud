<?php

namespace Modules\Customer\Actions;

use Modules\Customer\Models\Customer;
use Illuminate\Http\Request;

class Store
{
    public static function run(Request $request): Customer
    {
        return Customer::create($request->only(['nama', 'domisili', 'jenis_kelamin']));
    }
}
