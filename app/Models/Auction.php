<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $guarded = [];
    use \Eloquence\Behaviours\CamelCasing;
    public function medias()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class,'artist_id');
    }

}
