<?php

namespace App\Models\Product;

use App\Traits\HasStock;
use App\Traits\Wishlistable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements TranslatableContract, HasMedia, Buyable
{
    use Translatable, InteractsWithMedia, HasStock, Sluggable, Wishlistable, CanBeBought;
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

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }
    public function getBuyableWeight($options = null)
    {
        return $this->weight;
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);
    }

    public function firstImage()
    {
        return optional($this->getFirstMedia('images'))->getFullUrl() ?? asset('img/cart/thumbinal.png');
    }

    public function images()
    {
        return $this->getMedia('images');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, "product_characters");
    }
}
