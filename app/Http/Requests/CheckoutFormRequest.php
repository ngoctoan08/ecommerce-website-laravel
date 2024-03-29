<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutFormRequest extends FormRequest
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
                'name_partner' => [
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
                'user_id' => [
                    'required',
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