<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|alpha|min:3|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_dash|confirmed',
            'password_confirmation' => 'required|alpha_dash|'
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'имя пользователя',
            'email' => 'электронная почта',
            'password' => 'пароль',
            'password_confirmation' => 'подтверждение пароля'
        ];
    }
}
