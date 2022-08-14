<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'group_name' => [
                'required',
                'max:255',
                'regex:/^[^\-\!\[\]\{\}\"\'\>\<\%\^\*\?\/\\\|\,\;\:\+\=\(\)\@\$\&\!\.\#\_]*$/',
                Rule::unique('groups')->ignore($this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'group_name.required' => 'Tên không được để trống',
            'group_name.max' => 'Tên không được quá 255 kí tự',
            'group_name.regex' => 'Tên nhóm không được chứa các kí tự đặc biệt',
            'group_name.unique' => 'Tên nhóm đã tồn tại'
        ];
    }
}
