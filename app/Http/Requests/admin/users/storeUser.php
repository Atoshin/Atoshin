<?php

namespace App\Http\Requests\admin\users;

use Illuminate\Foundation\Http\FormRequest;

class
storeUser extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'email'=>'email',
            'wallet_address'=>'required|string|regex:/0x[a-fA-F0-9]{40}/',
            'email'=>'nullable|unique:users',
            'username'=>'nullable|unique:users'


        ];
    }
}
