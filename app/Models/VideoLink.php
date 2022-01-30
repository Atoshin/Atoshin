<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLink extends Model
{
    use HasFactory;
    protected $guarded = [];
    use \Eloquence\Behaviours\CamelCasing;

    public function videoLinkable()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

}
