<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
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
        'password' => 'hashed',
    ];

    public function role(): HasMany {
        return $this->hasMany(userRole::class, 'role_id');
    }
    public function product(): HasMany {
        return $this->hasMany(product::class, 'user_id');
    }
    public function image(): HasOne {
        return $this->hasOne(image::class, 'user_id');
    }
    public function userReview(): HasMany {
        return $this->hasMany(Review::class, 'user_id');
    }
    
    public function sellerReview(): HasMany {
        return $this->hasMany(Review::class, 'seller_id');
    }
    public function userOffers(): HasMany {
        return $this->hasMany(Offers::class, 'user_id');
    }
    
    public function sellerOffers(): HasMany {
        return $this->hasMany(Offers::class, 'seller_id');
    }

    public function userChats(): HasMany {
        return $this->hasMany(Chat::class, 'user_id');
    }
    
    public function sellerChats(): HasMany {
        return $this->hasMany(Chat::class, 'seller_id');
    }
}
