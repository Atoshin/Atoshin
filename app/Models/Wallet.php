<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    use \Eloquence\Behaviours\CamelCasing;

    protected $guarded = [];
    protected $hidden = [
        "walletable_id",
        "walletable_type",
        "created_at",
        "updated_at",
    ];
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }


    public function walletable()
    {
        return $this->morphTo();
    }
}
