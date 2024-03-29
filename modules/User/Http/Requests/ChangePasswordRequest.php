<?php

namespace User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use User\Rules\ValidPassword;
use User\Services\VerifyCodeService;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->check())
        return true;

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required', new ValidPassword(), 'confirmed']
        ];
    }
}
