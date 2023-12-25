<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'condition',
        'price',
        'description',
        'category_id'
    ];

    public function category(): HasMany {
        return $this->hasMany(category::class, 'category_id');
    }

    public function image(): HasMany {
        return $this->hasMany(image::class, 'product_id');
    }

    public function User(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offer(): HasMany {
        return $this->hasMany(offers::class, 'product_id');
    }

    public function review(): HasMany {
        return $this->hasMany(review::class, 'product_id');
    }
}
