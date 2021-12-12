<?php

namespace App\Http\Requests\admin\artist;

use Illuminate\Foundation\Http\FormRequest;

class updateArtist extends FormRequest
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
            'bio'=>'max: 1000|required',
            'website'=>'url',
            'twitter'=>'url',
            'facebook'=>'url',
            'instagram'=>'url',
            'linkedin'=>'url',
            'youtube'=>'url',

        ];
    }
}
