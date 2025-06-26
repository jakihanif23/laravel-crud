<?php

namespace Modules\Sale\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if ($this->has('customer_id') && preg_match('/\d+$/', $this->customer_id, $matches)) {
            $this->merge([
                'customer_id' => (int) $matches[0],
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
            'tgl'          => 'required|date',
            'customer_id'  => 'required|exists:customers,id',
            'subtotal'     => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'tgl.required'         => 'Tanggal wajib diisi.',
            'tgl.date'             => 'Tanggal tidak valid.',
            'customer_id.required' => 'Pelanggan wajib dipilih.',
            'customer_id.exists'   => 'Pelanggan tidak ditemukan.',
            'subtotal.required'    => 'Subtotal wajib diisi.',
            'subtotal.numeric'     => 'Subtotal harus berupa angka.',
            'subtotal.min'         => 'Subtotal tidak boleh negatif.',
        ];
    }
}
