<?php

namespace App\Http\Requests\admin\newsletter;

use Illuminate\Foundation\Http\FormRequest;

class storeNewsLetter extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

                  'email'=>'required|email'


        ];
    }
}
