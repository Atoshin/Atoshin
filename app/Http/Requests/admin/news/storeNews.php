<?php

namespace App\Http\Requests\admin\news;

use Illuminate\Foundation\Http\FormRequest;

class storeNews extends FormRequest
{
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link'=>'required|url',
            'title'=>'required'
        ];
    }
}
