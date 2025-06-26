<?php

namespace Modules\Transaction\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if ($this->has('sale_id') && str_starts_with($this->sale_id, 'NOTA_')) {
            $this->merge([
                'sale_id' => (int) str_replace('NOTA_', '', $this->sale_id),
            ]);
        }

        if ($this->has('item_id') && str_starts_with($this->item_id, 'BRG_')) {
            $this->merge([
                'item_id' => (int) str_replace('BRG_', '', $this->item_id),
            ]);
        }
    }
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'sale_id'   => 'required|exists:sales,id',
            'item_id'   => 'required|exists:items,id',
            'qty'       => 'required|integer|min:1',
            'harga'     => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'sale_id.required'   => 'Sale ID wajib diisi.',
            'sale_id.exists'     => 'Sale tidak ditemukan.',
            'item_id.required'   => 'Item wajib dipilih.',
            'item_id.exists'     => 'Item tidak ditemukan.',
            'qty.required'       => 'Qty wajib diisi.',
            'qty.integer'        => 'Qty harus berupa angka.',
            'qty.min'            => 'Qty minimal 1.',
            'harga.required'     => 'Harga wajib diisi.',
            'harga.numeric'      => 'Harga harus berupa angka.',
            'harga.min'          => 'Harga minimal 0.',
            'subtotal.required'  => 'Subtotal wajib diisi.',
            'subtotal.numeric'   => 'Subtotal harus berupa angka.',
            'subtotal.min'       => 'Subtotal minimal 0.',
        ];
    }
}
