<?php

namespace App\Models\Product;

use App\Casts\Money;
use App\Traits\HasStock;
use App\Traits\Wishlistable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cknow\Money\MoneyCast;
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

    protected $casts = [
        'price' => MoneyCast::class
    ];

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

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * {@inheritdoc}
     */
    public function hasOptions()
    {
        return (!$this->options->isEmpty());
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addOption(OptionInterface $option)
    {
        if (!$this->hasOption($option)) {
            $this->options->push($option);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {
        if ($this->hasOption($option)) {
            foreach ($this->options as $key => $item) {
                if ($item->getKey() === $option->getKey()) {
                    $this->options->forget($key);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionInterface $option)
    {
        return $this->options->contains($option);
    }
}
