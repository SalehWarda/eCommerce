<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
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

                    'name'  => 'required|max:255|unique:states' ,
                    'status'      =>'required',
                    'country_id' =>'required'

                ];
            }

            case 'PUT':
            case 'PATCH':
            {
                return [

                    'name'  => 'required|max:255|unique:states,name,'.$this->id ,
                    'status'      =>'required',
                    'country_id' =>'required'

                ];
            }

            default: break;


        }
    }
}
