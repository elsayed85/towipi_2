<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Item;

class ReturnedItem extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class);
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
