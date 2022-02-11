<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyRequest extends FormRequest
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

            case 'POST':{
                return [
                    'name' => 'required|max:255',
                    'code' => 'required|unique:shipping_companies',
                    'description' => 'required',
                    'fast' => 'required|in:0,1',
                    'cost' => 'required',
                    'status' => 'required|in:0,1',
                    'countries' =>'required'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:255',
                    'code' => 'required|unique:shipping_companies,code,'.$this->id,
                    'description' => 'required',
                    'fast' => 'required|in:0,1',
                    'cost' => 'required',
                    'status' => 'required|in:0,1',
                     'countries' =>'required'
                ];
            }
            default: break;
        }
    }
}
