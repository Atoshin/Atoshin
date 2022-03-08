<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['url', 'size'];
    use \Eloquence\Behaviours\CamelCasing;

    public function mediable()
    {
        return $this->morphTo();
    }
    public function getUrlAttribute()
    {
        return env('APP_URL') . '/' . $this->path;
    }

    public function getSizeAttribute()
    {
        if ($this->mediable_type != Contract::class){
            $data = getimagesize($this->path);
            return [
                'width' => $data[0],
                'height' => $data[1]
            ];
        }else {
            return [];
        }
    }
}
