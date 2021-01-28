<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Character extends Model implements TranslatableContract
{
    use Translatable;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, "product_characters");
    }
}
