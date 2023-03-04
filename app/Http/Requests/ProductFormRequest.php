<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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

        if(request()->isMethod('POST')) 
        {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:191'
                ],
                'description' => [
                    'required',
                    'string',
                    'min:1',
                ],
                'price' => [
                    'required',
                    'min:1',
                ],
            ];
        }
        else if(request()->isMethod('PUT'))
        {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:191'
                ],
                'description' => [
                    'required',
                    'string',
                    'min:1',
                ],
            ];
        }
        
        return $rules;

    }
}
