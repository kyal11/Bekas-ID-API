<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class image extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'context',
        'name_file_image'
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function User(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
