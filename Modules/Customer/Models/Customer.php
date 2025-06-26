<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['nama', 'domisili', 'jenis_kelamin'];
    protected $hidden = ['id'];
    protected $appends = ['kode'];

    public function getKodeAttribute(): string
    {
        return 'PELANGGAN_' . $this->id;
    }
}
