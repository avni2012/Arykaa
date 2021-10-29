<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            "name" => "required|max:255",
            //"last_name" => "required|max:255",
            "mobile_no" => "required|unique:users|numeric",
            "email" => "required|unique:users",
            "password" => "required|min:8",
            /*"dob" => "required|date_format:Y-m-d",
            "address_line_1" => "required",
            "address_line_2" => "required",
            "address_line_3" => "nullable",
            "country_id" => "required|exists:countries,id",
            "state_id" => "required|exists:states,id",
            "city_id" => "required|exists:cities,id",
            "post_code" => "required|numeric",
            "remarks" => "required",*/
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
            //'first_name.required' => 'The first name field is required.',
            //'last_name.required' => 'The last name field is required.',
        ];
    }
}
