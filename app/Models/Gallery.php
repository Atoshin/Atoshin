<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function asset()
    {
        return $this->hasOne(Asset::class, 'creator_id');
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
