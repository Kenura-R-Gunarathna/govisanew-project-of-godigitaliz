<?php
namespace App\Http\Requests\Backend\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'               => 'required|max:20',
            'email'              => 'required|email|max:100',
            'category'           => 'required',
            'status'             => 'required',
            'role'               => 'required',
            'is_featured'        => 'sometimes',
            'new_password'       => 'nullable|min:8',
        ];
    }
}
