<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDisposalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'asset_id' => ['required', 'exists:assets,id'],
            'disposal_date' => ['required', 'date'],
            'disposal_reason' => ['required', 'string'],
            'disposal_value' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
