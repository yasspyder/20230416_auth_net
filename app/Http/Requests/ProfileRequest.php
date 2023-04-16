<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|alpha|min:3|max:255',
            'email' => 'required|email|max:255',
            'role' => 'filled|alpha',
            'password' => 'required',
            'password_new' => 'required|alpha_dash|min:8',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'имя пользователя',
            'email' => 'электронная почта',
            'role' => 'права пользователя',
            'password' => 'старый пароль',
            'password_new' => 'новый пароль',
        ];
    }
}
