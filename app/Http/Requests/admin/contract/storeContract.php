<?php

namespace App\Http\Requests\admin\contract;

use Illuminate\Foundation\Http\FormRequest;

class storeContract extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contract_number'=>'required'
        ];
    }
}
