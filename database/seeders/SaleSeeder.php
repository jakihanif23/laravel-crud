<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customer\Models\Customer;
use Modules\Sale\Models\Sale;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $sales = [
            ['tgl' => '2025-01-01', 'kode_pelanggan' => 'PELANGGAN_1', 'subtotal' => 50000],
            ['tgl' => '2025-01-01', 'kode_pelanggan' => 'PELANGGAN_2', 'subtotal' => 200000],
            ['tgl' => '2025-01-01', 'kode_pelanggan' => 'PELANGGAN_3', 'subtotal' => 430000],
            ['tgl' => '2025-02-01', 'kode_pelanggan' => 'PELANGGAN_7', 'subtotal' => 120000],
            ['tgl' => '2025-02-01', 'kode_pelanggan' => 'PELANGGAN_4', 'subtotal' => 40000],
            ['tgl' => '2025-03-01', 'kode_pelanggan' => 'PELANGGAN_8', 'subtotal' => 230000],
            ['tgl' => '2025-03-01', 'kode_pelanggan' => 'PELANGGAN_9', 'subtotal' => 390000],
            ['tgl' => '2025-03-01', 'kode_pelanggan' => 'PELANGGAN_5', 'subtotal' => 65000],
            ['tgl' => '2025-04-01', 'kode_pelanggan' => 'PELANGGAN_2', 'subtotal' => 40000],
        ];

        foreach ($sales as $index => $sale) {
            $customerId = Customer::whereRaw("CONCAT('PELANGGAN_', id) = ?", [$sale['kode_pelanggan']])->value('id');

            if ($customerId) {
                Sale::create([
                    'tgl' => $sale['tgl'],
                    'customer_id' => $customerId,
                    'subtotal' => $sale['subtotal'],
                ]);
            }
        }
    }
}
