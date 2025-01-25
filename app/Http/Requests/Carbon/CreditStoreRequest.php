<?php

namespace App\Http\Requests\Carbon;

use App\Services\SerialNumberGenerator;
use Illuminate\Foundation\Http\FormRequest;

class CreditStoreRequest extends FormRequest
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
            'project_ID' => 'required|exists:carbon_projects,id',
            'price_per_ton' => 'required|numeric|min:0',
            'quantity_available' => 'required|integer|min:0',
            'minimum_purchase' => 'required|integer|min:1',
            'status' => 'required|in:available,sold,retired',
            'start_date' => 'nullable|date|before_or_equal:end_date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}
