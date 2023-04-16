<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'category_id' => 'filled|not_in:0|integer',
            'title' => 'filled|string|min:3|max:250',
            'text' => 'filled|string|min:5',
            'is_private' => 'sometimes|accepted',
        ];
    }

    public function attributes(): array
    {
        return [
            'category_id' => 'категории новостей',
            'title' => 'заголовок новости',
            'text' => 'текст новости',
        ];
    }
}
