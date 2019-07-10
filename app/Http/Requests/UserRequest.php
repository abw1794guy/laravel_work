<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.unique' => '用戶名已被占用，請重新填寫',
            'name.regex' => '用戶名只支持英文、數字、橫杠和下劃線。',
            'name.between' => '用戶名必須介於 3 - 25 個字符之間。',
            'name.required' => '用戶名不能為空。',        ];
    }
}
