<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'user_name' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmed' => 'required',
        ];
    }

    // エラーメッセージのカスタマイズ、多言語対応させるのでここではtransで飛べるように共通の引数を設定しておく
    public function messages() {
        return [
            'user_name.required' => 'user_name.validation',
            'email.required' => '',
            'password.required' => '',
            'password_confirmed.required' => '',

        ];
    }
}
