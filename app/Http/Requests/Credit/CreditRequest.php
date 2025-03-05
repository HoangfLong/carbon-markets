<?php

namespace App\Http\Requests\Credit;

use Illuminate\Foundation\Http\FormRequest;

class CreditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_ID' => 'required|exists:projects,id',
            'price_per_ton' => 'required|numeric|min:0',
            'quantity_available' => 'required|integer|min:0',
            'minimum_purchase' => 'required|integer|min:1',
            'validator' => 'nullable|string|max:255',
            'standard_id' => 'required|exists:standards,id',
            'status' => 'required|in:Registered,Retired',
            'start_date' => 'nullable|date|before_or_equal:end_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}
