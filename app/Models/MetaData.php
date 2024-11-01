<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaData extends Model
{
    use HasFactory;
    protected $fillable=[
        'token_id',
        'metadata_uri',
        'asset_id'];

    public function asset()
    {
        return $this->belongsTo(Asset::class,'asset_id');
    }
}
