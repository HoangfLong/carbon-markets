<?php

namespace App\Http\Requests\Project;

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
            'project_type_ID' => 'required|exists:project_types,id',
            // 'carbon_credit_ID' => 'required|numeric',
            'user_ID' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'developer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'registered_at' => 'nullable|date',
            'total_credits' => 'required|numeric',
            'status' => 'required|in:Planned,Estimated,Certified', // Kiểm tra giá trị hợp lệ
            'is_verified' => 'required|boolean',
            'images' => 'nullable|array', // Đảm bảo 'images' là mảng file
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Mỗi phần tử trong mảng phải là ảnh và có định dạng jpg, jpeg, png
        ];
    }
}
