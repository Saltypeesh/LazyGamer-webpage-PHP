<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Platform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'tags', 'banner', 'background', 'plat_id' ,'user_id', 'description'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['platform'] ?? false) {
            $query->where('plat_id', 'like', '%' . request('platform') . '%');
        }

        if ($filters['search'] ?? false) {
            
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'plat_id');
    }

    public function carts()
    {
        return $this->belongsToMany(User::class, 'carts', 'listing_id', 'user_id')
            ->using(Cart::class)
            ->withTimestamps()
            ->withPivot('amount');
    }
}
