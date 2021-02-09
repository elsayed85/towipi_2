<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class ReturnedItem extends Model
{
    use BelongsToThrough;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function product()
    {
        return $this->belongsToThrough(Product::class, OrderItem::class, null, '', [
            Product::class => "product_id",
            OrderItem::class => "item_id"
        ]);
    }


    public function order(){
        return $this->belongsToThrough(Order::class, OrderItem::class, null, '', [
            Order::class => "order_id",
            OrderItem::class => "item_id"
        ]);
    }

    public function isWaitingForAccept()
    {
        return is_null($this->accepeted);
    }

    public function getStatusStrAttribute()
    {
        if ($this->isWaitingForAccept()) {
            return "waiting for accept";
        } elseif ($this->isAccepted()) {
            return "accepted";
        } elseif ($this->isRejected()) {
            return "rejected";
        }
    }

    public function isAccepted()
    {
        return !is_null($this->accepeted) && $this->accepeted == true;
    }

    public function isRejected()
    {
        return !is_null($this->accepeted) && $this->accepeted == false;
    }

    public function scopeWaitingForAccepet(Builder $query)
    {
        return $query->whereNull("accepeted");
    }

    public function scopeAccepeted(Builder $query)
    {
        return $query->whereNotNull("accepeted")->whereAccepeted(true);
    }

    public function scopeRejected(Builder $query)
    {
        return $query->whereNotNull("accepeted")->whereAccepeted(false);
    }
}
