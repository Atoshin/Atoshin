<?php

namespace App\Http\Requests\admin\admin;

use Illuminate\Foundation\Http\FormRequest;

class updateAdmin extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email',
            'username'=>'required|min:4',

        ];
    }

}
