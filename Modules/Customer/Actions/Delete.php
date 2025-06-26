<?php

namespace Modules\Customer\Actions;

use Modules\Customer\Models\Customer;

class Delete
{
    public static function run($id): bool
    {
        $customer = Customer::findOrFail($id);
        return $customer->delete();
    }
}
