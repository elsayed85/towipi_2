<?php

namespace App\Models;

use App\Models\General\Country;
use App\Models\General\Governorate;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class)->withDefault();
    }

    public function country()
    {
        return $this->hasOneThrough(Country::class , Governorate::class)->withDefault();
    }
}
