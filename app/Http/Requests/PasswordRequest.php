<?php

namespace App\Http\Requests;

use App\Rules\OldPassword;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => ['required', new OldPassword()],
            'new_password' => ['required','min:6'],
            'new_confirm_password' => ['required','same:new_password'],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Mật khẩu không được để trống',
            'new_password.required' => 'Mật khẩu không được để trống',
            'new_password.min' => 'Mật khẩu phải có ít nhất 6 kí tự',
            'new_confirm_password.same' => 'Mật khẩu không giống nhau. Vui lòng gặp lại!',
            'new_confirm_password.required' => 'Mật khẩu không được để trống',
        ];
    }

}
