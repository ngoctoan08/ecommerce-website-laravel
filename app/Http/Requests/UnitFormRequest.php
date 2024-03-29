<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitFormRequest extends FormRequest
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
                'conversion_unit' => [
                    'required',
                    'unique:units',
                    'string',
                    'min:2',
                    'max:191'
                ],
            ];
        }
        return $rules;
    }
}