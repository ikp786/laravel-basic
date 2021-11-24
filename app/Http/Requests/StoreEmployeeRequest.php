<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name'              => 'required', 
            'last_name'               => 'required',
            'company_id'              => 'required|exists:companies,id',
            'mobile' => [
                'required',                
                'max:10',
                'min:10',
                Rule::unique('employees'),
            ],
            'email' => [
                'required',
                'email',
                'max:200',
                Rule::unique('employees'),
            ],
        ];
    }
    public function messages(){

        return [
            'first_name.required' => 'First Name filed is missing',
            'last_name.required' => 'Last Name filed is missing',
            'email.unique'       => 'The email is already taken',
            'mobile.unique'       => 'The mobile number is already taken',
            'company_id.exists'    => 'Company  did not exist',
            
        ];
    }
}