<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'product_id',
        'review',
        'rating'
    ];

    public function User(): BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
    public function Seller(): BelongsTo {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(product::class, 'product_id');
    }

    
}
