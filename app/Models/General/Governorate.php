<?php

namespace App\Models\General;

use Cknow\Money\MoneyCast;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'shipping_price' => MoneyCast::class
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
