<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class CharacterTranslation extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
