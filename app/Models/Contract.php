<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    use \Eloquence\Behaviours\CamelCasing;

    protected $guarded = [];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function minted()
    {
        return $this->hasOne(Minted::class);
    }
}
