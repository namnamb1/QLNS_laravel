<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'password' => 'required|min:6',
            'email' => ['required','max:255',Rule::unique('members')->ignore($this->id)],
            'avatar' => 'mimes:jpg,png,jpeg|max:2048',
            'calc_shipping_provinces' => 'required|numeric',
            'calc_shipping_district' => 'required|string',
            'address' => 'required',
            'brith_date' => 'required|date',
            'department_id' => 'required|numeric',
            'group' => 'required',
            'gender' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Tên không được để trống',
            'full_name.max' => 'Tên không được quá 50 kí tự',
            'full_name.min' => 'Tên quá ngắn',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 kí tự',
            'email.required' => 'Email không được để trống',
            'email.max' => 'Email không được quá 255 kí tự',
            'email.unique' => 'Email đã tồn tại',
            'avatar.mimes' => 'Định dạng file ảnh không hợp lệ',
            'avatar.max' => 'Kính thước ảnh không được vượt quá 2048kb',
            'calc_shipping_provinces.required' => 'Tỉnh\Thành Phố thành không được để trống',
            'calc_shipping_provinces.numeric' => 'Tỉnh\Thành Phố không hợp lệ',
            'calc_shipping_district.required' => 'Huyện không được để trống',
            'calc_shipping_district.string' => 'Huyện không hợp lệ',
            'address.required' => 'Địa chỉ không được để trống',
            'brith_date.required' => 'Ngày sinh không được để trống',
            'brith_date.date_format' => 'Đinh dạng ngày không hợp lệ',
            'department_id.required' => 'Phòng ban chưa được chọn',
            'department_id.numeric' => 'Phòng ban không hợp lệ',
            'group.required' => 'Nhóm chưa được chọn',
            'gender.required' => 'Bạn chưa chọn giới tính',
            'gender.numeric' => 'Giới tính không hợp lệ'
        ];
    }
}
