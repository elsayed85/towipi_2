<?php

namespace App\Models\Product;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model implements TranslatableContract , OptionValueInterface
{
     use Translatable;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $translatedAttributes = ['value'];

    protected $translationForeignKey = "value_id";

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_option_values';

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

    /**
     * {@inheritdoc}
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * {@inheritdoc}
     */
    public function setOption(OptionInterface $option = null)
    {
        $this->option()->associate($option);

        return $this;
    }
}
