<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Otorisasi sudah ditangani oleh Middleware CheckRole pada route
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Mengambil instance model asset yang sedang diakses dari parameter URL (route)
        $asset = $this->route('asset');

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'location_id' => ['required', 'exists:locations,id'],
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'serial_number' => [
                'nullable',
                'string',
                'max:255',
                // Mengecualikan asset ini dari pengecekan duplikat serial number
                Rule::unique('assets', 'serial_number')->ignore($asset)
            ],
            'purchase_date' => ['required', 'date'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'condition' => ['required', Rule::in(['excellent', 'good', 'fair', 'poor'])],
            'status' => ['required', Rule::in(['active', 'maintenance', 'damaged', 'lost', 'disposed'])],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Maksimal 2MB
        ];
    }

    /**
     * Custom error messages (Opsional)
     */
    public function messages(): array
    {
        return [
            'serial_number.unique' => 'Serial number ini sudah digunakan oleh aset lain.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
    }
}
