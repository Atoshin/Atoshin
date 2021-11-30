<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $table='video_feeds';

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
