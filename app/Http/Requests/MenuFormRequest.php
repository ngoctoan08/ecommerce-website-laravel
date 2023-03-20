<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuFormRequest extends FormRequest
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
                    'unique:menus',
                    'string',
                    'min:2',
                    'max:191'
                ],
                'parent_id' => [
                    'required'
                ],
            ];
        }
        if(request()->isMethod('PUT')) 
        {
            $rules = [
                'name' => [
                    'required',
                    'unique:menus',
                    'string',
                    'min:200',
                ],
                'parent_id' => [
                ],
            ];
        }
        return $rules;
    }
}