<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'asset_id' => ['required', 'exists:assets,id'],
            'maintenance_type' => ['required', Rule::in(['preventive', 'corrective', 'inspection'])],
            'maintenance_date' => ['required', 'date'],
            'technician' => ['required', 'string', 'max:255'],
            'cost' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'], // Max 2MB dokumen/gambar
        ];
    }
}
