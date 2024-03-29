<?php

namespace User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use User\Models\User;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:190',
            'email' => 'required|email|min:3|max:190|unique:users,email,' . request()->route('user'),
            'username' => 'nullable|min:3|max:190|unique:users,username,' . request()->route('user'),
            'mobile' => 'nullable|unique:users,mobile,' . request()->route('user'),
            'status' => ['required', Rule::in(User::$statuses)],
            'image' => 'nullable|mimes:jpg,png,jpeg',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'نام',
            'email' => 'ایمیل',
            'username' => 'نام کاربری',
            'mobile' => 'شماره موبایل',
            'status' => 'وضعیت حساب',
            'image' => 'عکس پروفایل',
        ];
    }
}
