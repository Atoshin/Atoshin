<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    use \Eloquence\Behaviours\CamelCasing;


    protected $guarded = [];
    protected $hidden = ['transactable_id', 'transactable_type', 'updated_at'];

    public function transactable()
    {
        return $this->morphTo();
    }

    public function minteds()
    {
        return $this->hasMany(Minted::class);
    }
}
