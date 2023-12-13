<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class userRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'abilities'
    ];

    public function userRole(): BelongsTo {
        return $this->belongsTo(User::class,'role_id');
    }
}
