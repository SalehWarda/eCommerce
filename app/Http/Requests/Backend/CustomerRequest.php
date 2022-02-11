<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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

                    'first_name'  => 'required|max:255' ,
                    'last_name'   => 'required|max:255' ,
                    'username'    => 'required|max:20|unique:users',
                    'mobile'      => 'required|numeric|unique:users',
                    'status'      =>'required',
                    'email'       => 'required|email|unique:users',
                    'password'    =>'required|min:8',
                    'user_image'  =>'nullable|mimes:jpg,jpeg,png,svg|max:3000' ,
                ];
            }

                case 'PUT':
                case 'PATCH':
            {
                return [

                    'first_name'  => 'required|max:255' ,
                    'last_name'   => 'required|max:255' ,
                    'username'    => 'required|max:20|unique:users,username,'.$this->id,
                    'mobile'      => 'required|numeric|unique:users,mobile,'.$this->id,
                    'status'      =>'required',
                    'email'       => 'required|email|unique:users,email,'.$this->id,
                    'password'    =>'required|min:8',
                    'user_image'  =>'nullable|mimes:jpg,jpeg,png,svg|max:3000' ,

                ];
            }

            default: break;


        }
    }
}
