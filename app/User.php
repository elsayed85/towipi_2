<?php

namespace App;

use App\Models\Address;
use App\Models\General\Country;
use App\Traits\HasWishlist;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, LaratrustUserTrait, HasWishlist;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'phone', 'country_id', 'email_verified_at' , 'payment_card_last_four' , 'payment_card_brand' , 'payment_card_fawry_token'
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
        return $this->belongsTo(Country::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
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
