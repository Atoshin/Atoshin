<?php

namespace App\Http\Requests\admin\category;

use Illuminate\Foundation\Http\FormRequest;

class storeCategory extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required'

        ];
    }
}
