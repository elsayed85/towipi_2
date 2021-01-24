<?php

namespace App\Models\Product;

use App\Traits\HasStock;
use App\Traits\Wishlistable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements TranslatableContract, HasMedia
{
    use Translatable, InteractsWithMedia, HasStock , Sluggable , Wishlistable;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $translatedAttributes = ['title', 'description'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);
    }

    public function firstImage()
    {
        return $this->getFirstMedia('images');
    }

    public function images()
    {
        return $this->getMedia('images');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
