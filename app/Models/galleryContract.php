<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galleryContract extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'gallery_contracts';

    public function gallery()
    {
        return $this->belongsTo(gallery::class, 'gallery_id');
    }

    public function transaction()
    {
        return $this->morphOne(transaction::class, 'transactable');
    }


}
