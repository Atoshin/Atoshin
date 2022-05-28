<?php

namespace App\Http\Requests\admin\landing;

use Illuminate\Foundation\Http\FormRequest;

class updateLanding extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text'=>'required'

        ];
    }
}
