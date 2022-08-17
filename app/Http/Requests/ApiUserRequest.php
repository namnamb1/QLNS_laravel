<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ApiUserRequest extends FormRequest
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
            'full_name' => ['required','max:50','min:3','regex:/^[^\-\!\[\]\{\}\"\'\>\<\%\^\*\?\/\\\|\,\;\:\+\=\(\)\@\$\&\!\.\#\_0-9]*$/'],
            'email' => ['required','max:255',Rule::unique('api_user')->ignore($this->id)],
            'phone' => ['required','numeric'],
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Tên không được để trống',
            'email.required'  => 'Email không được để trống',
            'phone.required'  => 'Số điện thoại không được để trống',
            'full_name.max'  => 'Tên không được quá 50 kí tự',
            'full_name.min'  => 'Tên quá ngắn',
            'full_name.regex'  => 'Tên không được chứa các kí tự đặc biệt',
            'email.max' => 'Email không được quá 255 kí tự',
            'email.unique' => 'Email đã tồn tại',
            'phone.numeric' => 'Số điện thoại không hợp lệ'
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
                'status_code' => 422,
            ],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
