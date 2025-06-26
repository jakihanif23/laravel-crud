<?php

namespace Modules\Transaction\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Item\Models\Item;
use Modules\Sale\Models\Sale;

class Transaction extends Model
{
    protected $appends = ['id_transaksi'];
    protected $fillable = ['sale_id','item_id','qty','harga','subtotal'];

    protected $casts = [
        'qty'      => 'integer',
        'harga'    => 'float',
        'subtotal' => 'float',
    ];


    protected $hidden = ['sale_id', 'item_id', 'id'];

    public function getIdTransaksiAttribute(): string
    {
        return 'TRX_' . $this->id;
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
