<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'asset_id' => ['required', 'exists:assets,id'],
            'to_location_id' => ['required', 'exists:locations,id', 'different:from_location_id'],
            'transfer_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'to_location_id.different' => 'Lokasi tujuan tidak boleh sama dengan lokasi asal aset saat ini.',
        ];
    }
}
