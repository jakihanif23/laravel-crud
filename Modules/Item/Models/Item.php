<?php

namespace Modules\Item\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Transaction\Models\Transaction;

class Item extends Model
{
    protected $fillable = ['nama', 'kategori', 'harga'];

    protected $hidden = ['id'];

    protected $appends = ['kode'];

    public function getKodeAttribute(): string
    {
        return 'BRG_' . $this->id;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
