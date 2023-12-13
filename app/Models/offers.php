<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class offers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'price',
        'status'
    ];

    public function User(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Seller(): BelongsTo {
        return $this->belongsTo(User::class, 'seller_id');
    }
    public function chat(): HasMany {
        return $this->hasMany(chat::class, 'offer_id');
    }
    public function product(): BelongsTo {
        return $this->belongsTo(product::class, 'product_id');
    }
}
