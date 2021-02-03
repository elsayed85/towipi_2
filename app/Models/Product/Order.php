<?php

namespace App\Models\Product;

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
    const STATE_ABANDONED               = 'abandoned';
    const STATE_RETURNED                = 'returned';

    protected $dates = ['deleted_at', 'completed_at'];

    protected $casts = [
        'total' => MoneyCast::class,
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
}