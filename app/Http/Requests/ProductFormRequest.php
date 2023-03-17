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
                'code_id' => [
                    'bail',
                    'unique:products'
                ],
                'user_id' => [
                    'bail',
                    'required',
                ],
                'name' => [
                    'bail',
                    'required',
                    'string',
                    'min:2',
                    'max:191'
                ],
                'slug' => [
                    'bail',
                    'required',
                    'string',
                ],
                'category_id' => [
                    'bail',
                    'required',
                ],
                'description' => [
                    'bail',
                    'required',
                    'string',
                    'min:1',
                ],
                'entry_price' => [
                    'bail',
                    'required',
                    'min:1',
                ],
                'wholesale_price' => [
                    'bail',
                    'required',
                    'min:1',
                ],
                'retail_price' => [
                    'bail',
                    'required',
                    'min:1',
                ],
                'standard_stock' => [
                    'bail',
                    'required',
                    'min:1',
                ],
                'conversion_unit' => [
                    'bail',
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