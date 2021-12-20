<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $guarded = [];

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
}
