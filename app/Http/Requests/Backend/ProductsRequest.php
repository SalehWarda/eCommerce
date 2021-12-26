<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'product_category_id' => 'required',
                    'status'=>'required',
                    'quantity' => 'required|numeric',
                    'price' => 'required|numeric',
                    'featured'=>'required',
                    'tags.*' => 'required',
                    'images' => 'nullable',
                    'images.*'=> 'mimes:jpg,jpeg,png,gif|max:3000'

                ];
            };

            case 'PATCH':
            {

                return [
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'product_category_id' => 'required',
                    'status'=>'required',
                    'quantity' => 'required|numeric',
                    'price' => 'required|numeric',
                    'featured'=>'required',
                    'tags.*' => 'required',
                    'images' => 'nullable',
                    'images.*'=> 'mimes:jpg,jpeg,png,gif|max:3000'

                ];
            }



        }
        return [
            //
        ];
    }
}
