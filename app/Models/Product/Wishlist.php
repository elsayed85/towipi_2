<?php

namespace App\Models\Product;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
