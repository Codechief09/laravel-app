<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserModelRequest extends FormRequest
{
    /**
     * 認証関係の判定。特にない場合はreturn true。
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * バリデーションルールを記述
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
