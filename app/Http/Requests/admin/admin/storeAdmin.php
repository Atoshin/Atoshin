<?php

namespace App\Http\Requests\admin\admin;

use Illuminate\Foundation\Http\FormRequest;

class storeAdmin extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'email'=>'required|unique:admins|email',
                'username'=>'required|min:4',
                'password'=>'required'
        ];
    }
}
