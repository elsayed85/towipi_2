<?php

namespace App\Models\Product;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Option extends Model implements TranslatableContract , OptionInterface
{
    use Translatable;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $translatedAttributes = ['name'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_options';

    public function values()
    {
        return $this->hasMany(OptionValue::class, 'option_id');
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->values;
    }


    /**
     * {@inheritdoc}
     */
    public function setValues(Collection $optionValues)
    {
        $this->values = $optionValues;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addValue(OptionValueInterface $optionValue)
    {
        if (! $this->hasValue($optionValue)) {
            $optionValue->setOption($this);
            $this->values->push($optionValue);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(OptionValueInterface $optionValue)
    {
        if ($this->hasValue($optionValue)) {
            foreach ($this->values as $key => $item) {
                if ($item->getKey() === $optionValue->getKey()) {
                    $this->values->forget($key);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(OptionValueInterface $optionValue)
    {
        return $this->values->contains($optionValue);
    }
}
