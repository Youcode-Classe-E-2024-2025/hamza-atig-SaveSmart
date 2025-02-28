<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal',
        'category',
        'amount',
        'avatar',
        'target_date',
        'current_amount',
        'description',
        'user_id',
        'profile_id',
        'status',
    ];
}
