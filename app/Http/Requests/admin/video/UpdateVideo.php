<?php

namespace App\Http\Requests\admin\video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideo extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'link'=>'required|url'
        ];
    }
}
