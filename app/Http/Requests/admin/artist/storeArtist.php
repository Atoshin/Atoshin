<?php

namespace App\Http\Requests\admin\artist;

use Illuminate\Foundation\Http\FormRequest;

class storeArtist extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name'=>'required',
            'bio'=>'max:1000|required',
            'website'=>'url|nullable',
            'twitter'=>'url|nullable',
            'facebook'=>'url|nullable',
            'instagram'=>'url|nullable',
            'linkedin'=>'url|nullable',
            'youtube'=>'url|nullable',
        ];
    }
}
