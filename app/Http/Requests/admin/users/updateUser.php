<?php

namespace App\Http\Requests\admin\users;

use Illuminate\Foundation\Http\FormRequest;

class updateUser extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'nullable|unique:users|email',
            'username'=>'required|min:4',
            'first_name'=>'required',
            'last_name'=>'required',
            'bio'=>'required|max:1000',
            'wallet_address'=>'required|string|regex:/0x[a-fA-F0-9]{40}/'
        ];
    }
}
