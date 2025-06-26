<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Item\Models\Item;
use Modules\Sale\Models\Sale;
use Modules\Transaction\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['NOTA_1', 'BRG_1', 2],
            ['NOTA_1', 'BRG_2', 2],
            ['NOTA_2', 'BRG_6', 1],
            ['NOTA_3', 'BRG_4', 1],
            ['NOTA_3', 'BRG_7', 1],
            ['NOTA_3', 'BRG_6', 1],
            ['NOTA_4', 'BRG_9', 2],
            ['NOTA_4', 'BRG_10', 2],
            ['NOTA_4', 'BRG_3', 1],
            ['NOTA_5', 'BRG_7', 1],
            ['NOTA_6', 'BRG_5', 1],
            ['NOTA_6', 'BRG_3', 1],
            ['NOTA_7', 'BRG_5', 1],
            ['NOTA_7', 'BRG_6', 1],
            ['NOTA_7', 'BRG_7', 1],
            ['NOTA_7', 'BRG_8', 1],
            ['NOTA_8', 'BRG_5', 1],
            ['NOTA_8', 'BRG_9', 1],
            ['NOTA_9', 'BRG_9', 1],
            ['NOTA_10', 'BRG_5', 10],
        ];

        foreach ($rows as [$notaCode, $barangCode, $qty]) {
            $saleId = (int) str_replace('NOTA_', '', $notaCode);
            $itemId = (int) str_replace('BRG_', '', $barangCode);

            $item = Item::find($itemId);
            $sale = Sale::find($saleId);

            if (!$item || !$sale) {
                continue;
            }

            Transaction::create([
                'sale_id'  => $sale->id,
                'item_id'  => $item->id,
                'qty'      => $qty,
                'harga'    => $item->harga,
                'subtotal' => $qty * $item->harga,
            ]);
        }
    }
}
