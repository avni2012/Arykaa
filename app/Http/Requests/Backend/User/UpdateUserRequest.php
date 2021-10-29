<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            "mobile_no" => "required|numeric|regex:/[0-9]{9}/|unique:users,mobile_no,".$this->route('manage_user').",id,deleted_at,NULL",
            "email" => "unique:users,email,".$this->route('manage_user').",id,deleted_at,NULL",
            "date_of_birth" => "required|date_format:Y-m-d|before:today",
            "gender" => "required|in:1,2,3",
            'industry' => 'required|not_in:0',
            'work_experience' => 'required|not_in:0',
            'education_level' => 'required|not_in:0',
            'address' => 'required|min:2|max:255',
            "status" =>"nullable|in:0,1"
        ];
    }
}
