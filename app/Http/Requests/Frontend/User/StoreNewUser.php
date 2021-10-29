<?php

namespace App\Http\Requests\Frontend\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewUser extends FormRequest
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
                'name'  => 'required|min:2|max:255',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|min:8',
                'confirm_password' => 'required|min:8||same:password',
                'mobile_no' => 'required|numeric|digits_between:6,16|unique:users,mobile_no,NULL,id,deleted_at,NULL',
                'plan' => 'required|not_in:0',
                'agree_terms' => 'required',
                "status" =>"required|in:1,0"
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }
}
