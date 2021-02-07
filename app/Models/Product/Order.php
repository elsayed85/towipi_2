<?php

namespace App\Models\Product;

use App\Models\Payment\Payment;
use App\User;
use Cknow\Money\MoneyCast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

class Order extends Model
{
    use SoftDeletes, HasStatuses;

    const STATE_PLACED                  = 'placed';
    const STATE_CANCELLED               = 'cancelled';
    const STATE_PENDING                 = 'pending';
    const STATE_READEY_FOR_SHIPPING     = 'readyforshipping';
    const STATE_SHIPPED                 = 'shipped';
    const STATE_RETURNED                = 'returned';
    const STATE_DELIVERED               = 'delivered';

    protected $dates = ['deleted_at', 'completed_at'];

    protected $casts = [
        'total' => MoneyCast::class,
        'tax_total' => MoneyCast::class,
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class);
    }

    public function getShippingPriceAttribute()
    {
        return optional($this->shippingAddress)->governorate->shipping_price;
    }

    public function getTotalWithShippingAttribute()
    {
        return $this->total->add($this->shipping_price);
    }

    public function getOrderNumberAttribute($value)
    {
        return  'ORD-' . $value;
    }

    public function setPlaced($reason  = null)
    {
        $this->setStatus(static::STATE_PLACED, $reason);
    }

    public function setCancelled($reason  = null)
    {
        $this->setStatus(static::STATE_CANCELLED, $reason);
    }

    public function setPending($reason  = null)
    {
        $this->setStatus(static::STATE_PENDING, $reason);
    }

    public function setReadyForShipping($reason  = null)
    {
        $this->setStatus(static::STATE_READEY_FOR_SHIPPING, $reason);
    }

    public function setShipped($reason  = null)
    {
        $this->setStatus(static::STATE_SHIPPED, $reason);
    }

    public function isPaid()
    {
        return $this->payment_status;
    }

    public function setAsPaid()
    {
        $this->payment_status = true;
        return $this;
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
