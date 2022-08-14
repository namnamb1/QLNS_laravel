<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'department_name' => [
                'required',
                'max:255',
                'regex:/^[^\-\!\[\]\{\}\"\'\>\<\%\^\*\?\/\\\|\,\;\:\+\=\(\)\@\$\&\!\.\#\_]*$/',
                Rule::unique('departments')->ignore($this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'department_name.required' => 'Tên không được để trống',
            'department_name.max' => 'Tên không được quá 255 kí tự',
            'department_name.regex' => 'Tên phòng ban không được chứa các kí tự đặc biệt',
            'department_name.unique' => 'Tên phòng ban đã tồn tại'
        ];
    }
}
