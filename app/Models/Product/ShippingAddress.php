<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
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

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_shipping_addresses';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
