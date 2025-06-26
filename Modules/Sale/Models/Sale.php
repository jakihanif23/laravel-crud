<?php

namespace Modules\Sale\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Models\Customer;
use Modules\Transaction\Models\Transaction;

class Sale extends Model
{
    protected $fillable = ['tgl', 'customer_id', 'subtotal'];

    protected $appends = ['id_nota'];

    protected $hidden = ['id', 'customer_id'];

    protected $casts = ['subtotal' => 'float'];

    public function getIdNotaAttribute(): string
    {
        return 'NOTA_' . $this->id;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
