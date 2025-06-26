<?php

namespace Modules\Customer\Actions;

use Illuminate\Http\Request;
use Modules\Customer\Models\Customer;

class Update
{
    public static function run(Request $request, $id): Customer
    {
        $customer = Customer::findOrFail($id);

        $customer->update($request->only([
            'nama',
            'domisili',
            'jenis_kelamin',
        ]));

        return $customer;
    }
}
