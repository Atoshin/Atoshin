<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function videoFeeds()
    {
        return $this->hasMany(VideoFeed::class);
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
}
