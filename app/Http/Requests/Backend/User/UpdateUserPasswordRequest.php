<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
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
                /*'new_password' => 'required|min:8|different:current_password|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@\!#\$\^%&*()+=\-;,":<>\?]).{6,}$/i',*/
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password'
            ];
        /*[
        'new_password.regex' => 'Password must contain at least 6 characters, Including Upper/Lowercase, special character and numbers'
        ];*/
    }
}
