<?php

namespace App;

use App\Models\General\Country;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laratrust\Traits\LaratrustUserTrait;
use Rinvex\Addresses\Traits\Addressable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, LaratrustUserTrait, Addressable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function updatePassword($password)
    {
        return $this->update(['password' => Hash::make($password)]);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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
