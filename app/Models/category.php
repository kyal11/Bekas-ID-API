<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(product::class, 'category_id');
    }
}
