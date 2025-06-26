<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Customer\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'ANDI',   'domisili' => 'JAK-UT',  'jenis_kelamin' => 'PRIA'],
            ['nama' => 'BUDI',   'domisili' => 'JAK-BAR', 'jenis_kelamin' => 'PRIA'],
            ['nama' => 'JOHAN',  'domisili' => 'JAK-SEL', 'jenis_kelamin' => 'PRIA'],
            ['nama' => 'SINTAH', 'domisili' => 'JAK-TIM', 'jenis_kelamin' => 'WANITA'],
            ['nama' => 'ANTO',   'domisili' => 'JAK-UT',  'jenis_kelamin' => 'PRIA'],
            ['nama' => 'BUJANG', 'domisili' => 'JAK-BAR', 'jenis_kelamin' => 'PRIA'],
            ['nama' => 'JOWAN',  'domisili' => 'JAK-SEL', 'jenis_kelamin' => 'PRIA'],
            ['nama' => 'SINTIA', 'domisili' => 'JAK-TIM', 'jenis_kelamin' => 'WANITA'],
            ['nama' => 'BUTET',  'domisili' => 'JAK-BAR', 'jenis_kelamin' => 'WANITA'],
            ['nama' => 'JONNY',  'domisili' => 'JAK-SEL', 'jenis_kelamin' => 'WANITA'],
        ];

        foreach ($data as $customer) {
            Customer::create($customer);
        }
    }
}
