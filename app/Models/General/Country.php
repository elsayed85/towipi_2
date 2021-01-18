<?php

namespace App\Models\General;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
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

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
