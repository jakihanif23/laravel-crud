<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Item\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama' => 'PEN',      'kategori' => 'ATK',       'harga' => 15000],
            ['nama' => 'PENSIL',   'kategori' => 'ATK',       'harga' => 10000],
            ['nama' => 'PAYUNG',   'kategori' => 'RT',        'harga' => 70000],
            ['nama' => 'PANCI',    'kategori' => 'MASAK',     'harga' => 110000],
            ['nama' => 'SAPU',     'kategori' => 'RT',        'harga' => 40000],
            ['nama' => 'KIPAS',    'kategori' => 'ELEKTRONIK','harga' => 200000],
            ['nama' => 'KUALI',    'kategori' => 'MASAK',     'harga' => 120000],
            ['nama' => 'SIKAT',    'kategori' => 'RT',        'harga' => 30000],
            ['nama' => 'GELAS',    'kategori' => 'RT',        'harga' => 25000],
            ['nama' => 'PIRING',   'kategori' => 'RT',        'harga' => 35000],
        ];

        foreach ($items as $index => $item) {
            Item::create([
                'nama' => $item['nama'],
                'kategori' => $item['kategori'],
                'harga' => $item['harga'],
            ]);
        }
    }
}
