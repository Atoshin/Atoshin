<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    use LogsActivity;
    const TYPE_ASSETS = 'assets';
    const STATUS_ACTIVE = 'active';
    const STATUS_DEACTIVATE = 'deactivate';

    public static $status = [self::STATUS_ACTIVE, self::STATUS_DEACTIVATE];
    public static $type = [self::TYPE_ASSETS];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected $fillable = [
        'slug',
        'title',
        'description',
        'status',
        'parent_id',
        'categoryable_id',
        'categoryable_type',
    ];
    public function getAllDescendantIds(): array
    {
        $ids = [];

        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->getAllDescendantIds());
        }

        return $ids;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public static function getTypes(): array
    {
        return self::$type;
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
    public function categoryable(){
        return $this->morphTo();
    }

    public function asset()
    {
        return $this->hasOne(Asset::class);
    }
}
