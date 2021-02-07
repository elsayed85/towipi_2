<?php

namespace App\Models\Payment;

use App\Models\Product\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
