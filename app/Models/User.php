<?php

namespace App\Models;

use App\Models\Listing;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'profile_img',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship with Listing
    public function listings()
    {
        return $this->hasMany(Listing::class, 'user_id');
    }

    // Role attribute
    protected function role(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["customer", "admin"][$value]
        );
    } 
    
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'carts', 'listing_id', 'user_id')
            ->using(Cart::class)
            ->withTimestamps()
            ->withPivot('amount');
    }
}
