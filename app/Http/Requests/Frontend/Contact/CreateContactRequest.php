<?php
namespace App\Http\Requests\Frontend\Contact;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => 'required|max:20',
            'email'    => 'required|email',
            'subject'  => 'required|max:50',
            'message'  => 'required|max:255'
        ];
    }
}
