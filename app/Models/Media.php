<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['url'];
    use \Eloquence\Behaviours\CamelCasing;

    public function mediable()
    {
        return $this->morphTo();
    }
    public function getUrlAttribute()
    {
        return env('APP_URL') . '/' . $this->path;
    }
}
