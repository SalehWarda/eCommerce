<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductsCategoriesRequest extends FormRequest
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
        switch ($this->method()){

            case 'POST':
            {
                return [

                    'name' => 'required|max:255|unique:product_categories',
                    'status' => 'required',
                    'parent_id' => 'nullable',
                    'cover' => 'required|mimes:jpg,jpeg,png|max:2000'
                ];
            }

            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255|unique:product_categories,name,'.$this->id,
                    'status' => 'required',
                    'parent_id' => 'nullable',
                    'cover' => 'nullable|mimes:jpg,jpeg,png|max:2000'

                ];
            }

            default: break;


        }

    }
}
