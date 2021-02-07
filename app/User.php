<?php

namespace App;

use App\Models\Address;
use App\Models\General\Country;
use App\Models\Product\Complaint;
use App\Models\Product\Order;
use App\Traits\HasWishlist;
use BeyondCode\Vouchers\Traits\CanRedeemVouchers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, LaratrustUserTrait, HasWishlist, CanRedeemVouchers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'phone', 'country_id', 'email_verified_at', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return "{$this->fname} {$this->lname}";
    }

    public function updatePassword($password)
    {
        return $this->update(['password' => Hash::make($password)]);
    }

    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function scopeActive(Builder $q)
    {
        return $q->whereIsActive(true);
    }

    // AdminLte
    public function adminlte_image()
    {
        return 'https://ui-avatars.com/api/?name=' . $this->name;
    }

    public function adminlte_desc()
    {
        return 'That\'s a nice guy';
    }

    public function adminlte_profile_url()
    {
        return 'profile/username';
    }
}
