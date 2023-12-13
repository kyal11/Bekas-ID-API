<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'offer_id',
        'chat'
    ];

    public function offer(): BelongsTo {
        return $this->belongsTo(offers::class, 'offer_id');
    }
    public function User(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Seller(): BelongsTo {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
