<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['avatar_url'];
    use \Eloquence\Behaviours\CamelCasing;

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function videoLinks()
    {
        return $this->morphMany(VideoLink::class, 'video_linkable');
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    public function getAvatarUrlAttribute()
    {
        return env('APP_URL') . '/' . $this->avatar;
    }


}
