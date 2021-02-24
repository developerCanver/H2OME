<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        return [
            // 'name' => 'required|max:150',
            // 'email' => 'required|email|max:150|unique:users',
            // 'password'=>'min:6|cofirmed'

             'name' => 'required|max: 150',
             'email' => 'required|email|max:150|unique:users',
             'password' => 'required|min:6|max:150',
            //  'slug'=>'required'
             /**|unique:users */  
        ];
    }
}
