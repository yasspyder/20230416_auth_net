<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResourcesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'resource_name' => 'filled|string|max:250',
            'resource_description' => 'filled|string',
            'resource_url' => 'filled|string|url',
            ];
    }

    public function attributes(): array
    {
        return [
            'resource_name' => 'название ресурса',
            'resourse_description' => 'описание ресурса',
            'resource_url' => 'URL ресурса',
        ];
    }
}
