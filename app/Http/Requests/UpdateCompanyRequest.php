<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',            
             'logo' => [                
                Rule::dimensions()->maxWidth(100)->maxHeight(100)
            ],
        ];
    }

    public function messages(){

        return [
            'name.required' => 'Name filed is missing',
            'email.required'   => 'Email filed is missing',
            
        ];
    }
}
