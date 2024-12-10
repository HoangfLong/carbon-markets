<?php

namespace App\Http\Requests\Carbon;

use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'developer' => 'required|string',
            'images' => 'nullable|array', // Đảm bảo 'images' là mảng file
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',// Mỗi phần tử trong mảng phải là ảnh và có định dạng jpg, jpeg, png
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}
