<?php

namespace App\Models\General;

use App\Models\Address;
use App\Models\Product\ShippingAddress;
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

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }
}
