<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerying extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
}
