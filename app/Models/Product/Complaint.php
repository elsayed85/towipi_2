<?php

namespace App\Models\Product;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Complaint extends Model
{
    use BelongsToThrough;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_complaints';

    public function product()
    {
        return $this->belongsToThrough(Product::class, OrderItem::class, null, '', [
            Product::class  => "product_id",
            OrderItem::class => "item_id"
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function order()
    {
        return $this->belongsToThrough(Order::class, OrderItem::class,  null, '', [
            Order::class  => "order_id",
            OrderItem::class => "item_id"
        ]);
    }
}
