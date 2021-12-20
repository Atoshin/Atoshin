<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $dates = ['start_date','end_date'];


    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'creator_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
    public function videoLinks()
    {
        return $this->morphMany(VideoLink::class, 'video_linkable');
    }
}
