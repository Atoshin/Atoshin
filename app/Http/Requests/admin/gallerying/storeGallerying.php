<?php

namespace App\Http\Requests\admin\gallerying;

use Illuminate\Foundation\Http\FormRequest;

class storeGallerying extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'full_name'=>'required',
            'telephone'=>'required'

        ];
    }
}
