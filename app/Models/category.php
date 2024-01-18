<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function product(): HasMany {
        return $this->hasMany(product::class, 'category_id');
    }
}
