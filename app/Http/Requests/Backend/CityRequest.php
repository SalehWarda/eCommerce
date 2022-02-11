<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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

                    'name'  => 'required|max:255|unique:cities' ,
                    'status'      =>'required',
                    'state_id' =>'required'

                ];
            }

            case 'PUT':
            case 'PATCH':
            {
                return [

                    'name'  => 'required|max:255|unique:cities,name,'.$this->id ,
                    'status'      =>'required',
                    'state_id' =>'required'

                ];
            }

            default: break;


        }
    }
}
