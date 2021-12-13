<?php

namespace App\Http\Requests\admin\location;

use Illuminate\Foundation\Http\FormRequest;

class storeLocation extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'lat'=>'required',
                'long'=>'required',
                'address'=>'required|min:3',

        ];
    }
}
