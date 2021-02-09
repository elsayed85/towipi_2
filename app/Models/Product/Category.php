<?php

namespace App\Models\Product;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements TranslatableContract, HasMedia
{
    use Sluggable, Translatable, InteractsWithMedia;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $translatedAttributes = ['name'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('icon')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);
    }

    public function getIconAttribute()
    {
        return optional($this->getFirstMedia('icon'))->getFullUrl() ?? asset('img/cart/thumbinal.png');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    public function isMain()
    {
        return is_null($this->parent_id);
    }

    public function getParentsNames()
    {
        $parents = collect([]);
        if ($this->parent) {
            $parent = $this->parent;
            while (!is_null($parent)) {
                $parents->push($parent);
                $parent = $parent->parent;
            }
            return $parents->push($this);
        } else {
            return [$this];
        }
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function childrenRecursive()
    {
        return $this->childs()->with(['childrenRecursive']);
    }

    public function scopeIds($query, $parent_id = null)
    {
        $parent_id  = is_null($parent_id) ? $this->id : $parent_id;
        $test = $query->where('parent_id', $parent_id)
            ->with(['childrenRecursive:id,parent_id']);
        $ids = $test->get(['id', 'parent_id']);
        $mainIds = $ids->pluck('id');
        $data  = $ids->map->childrenRecursive->collapse()->pluck('id')
            ->push($parent_id)
            ->merge($mainIds)
            ->all();
        return $data;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function allProducts()
    {
        return Product::whereHas("category", function ($category) {
            return $category->whereIn("categories.id", $this->ids());
        });
    }
}
