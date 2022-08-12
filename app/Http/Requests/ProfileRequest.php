<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'full_name' => 'required|max:50|min:3|string',
            'avatar' => 'mimes:jpg,png,jpeg|max:2048',
            'calc_shipping_provinces' => 'required|numeric',
            'calc_shipping_district' => 'required|string',
            'address' => 'required',
            'brith_date' => 'required|date',
            'gender' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'full_name.required' => 'Tên không được để trống',
            'full_name.max' => 'Tên không được quá 50 kí tự',
            'full_name.min' => 'Tên quá ngắn',
            'avatar.mimes' => 'Định dạng file ảnh không hợp lệ',
            'avatar.max' => 'Kính thước ảnh không được vượt quá 2048kb',
            'calc_shipping_provinces.required' => 'Tỉnh\Thành Phố thành không được để trống',
            'calc_shipping_provinces.numeric' => 'Tỉnh\Thành Phố không hợp lệ',
            'calc_shipping_district.required' => 'Huyện không được để trống',
            'calc_shipping_district.string' => 'Huyện không hợp lệ',
            'address.required' => 'Địa chỉ không được để trống',
            'brith_date.required' => 'Ngày sinh không được để trống',
            'brith_date.date' => 'Đinh dạng ngày không hợp lệ',
            'gender.required' => 'Bạn chưa chọn giới tính',
            'gender.numeric' => 'Giới tính không hợp lệ',
        ];
    }
}
