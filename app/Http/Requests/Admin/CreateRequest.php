<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|nullable|integer',
            'title' => 'required|string|min:3|max:250',
            'text' => 'required|string|min:5|max: 500',
            'is_private' => 'sometimes|accepted',
            'category_name' => 'nullable|string|min:3|max:50|required_if:category_id,0,'
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'категории новостей',
            'title' => 'заголовок новости',
            'text' => 'текст новости',
            'category_name' => 'создать категорию'
        ];
    }
}
