<?php
namespace App\Http\Requests\Backend\Plan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeatureRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'               => 'required|max:200'
        ];
    }
}
