<?php

namespace App\Models\Product;

use Cknow\Money\MoneyCast;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model implements OrderItemInterface
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

    protected $casts = [
        'unit_price' => MoneyCast::class
    ];

    /**
     * {@inheritdoc}
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function rate()
    {
        return $this->hasOne(Rate::class, 'item_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'item_id');
    }

    public function returned()
    {
        return $this->hasOne(ReturnedItem::class , 'item_id');
    }

    public function isReturned()
    {
        return $this->returned()->exists();
    }

    public function getOptionsAttribute($value)
    {
        return json_decode($value);
    }

    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * {@inheritdoc}
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unit_price = $unitPrice;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function calculateTotal()
    {
    }
}
