<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'creator_id');
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'walletable');
    }

    public function videoLinks()
    {
        return $this->morphMany(VideoLink::class, 'video_linkable');
    }
    public function gallerymanager()
    {
        return $this->hasMany(Gallerying::class,'gallery_id');
    }
}
