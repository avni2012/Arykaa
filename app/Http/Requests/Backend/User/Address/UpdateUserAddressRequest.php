<?php

namespace App\Http\Requests\Backend\User\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAddressRequest extends FormRequest
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
            "address_line_1" => "required",
            "address_line_2" => "required",
            "address_line_3" => "nullable",
            "country_id" => "required|exists:countries,id",
            "state_id" => "required|exists:states,id",
            "city_id" => "required|exists:cities,id",
            "post_code" => "required|numeric",
        ];
    }
}
