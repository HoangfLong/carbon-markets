<?php

namespace App\Http\Requests\Carbon;

use Illuminate\Foundation\Http\FormRequest;

class CreditUpdateRequest extends FormRequest
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
            'project_id' => 'required|exists:carbon_projects,id',
            'serial_number' => 'required|max:255|unique:carbon_credits,serial_number',
            'value' => 'required|numeric|min:0',
            'status' => 'required|in:available,sold,retired',
        ];
    }
}
