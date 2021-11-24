<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyRequest extends FormRequest
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
            'name'          => 'required', 
            'email'         => 'required',
            // 'logo'          => 'required',
            'logo' => [
                'required',
                Rule::dimensions()->maxWidth(1280)->maxHeight(720)
            ],


            // 'avatar' => 'dimensions:width=100,height=100|mimes:jpg,png,jpeg'
        ];
    }
    public function messages(){

        return [
            'name.required' => 'Name filed is missing',
            'logo.required' => 'Company Logo should be required',
            'mimes.required'=> 'Logo format jpg,jpeg,png,gif,svg,webp',
            'mimes.maxWidth' => 'image shoul be 100px'
        ];
    }
}