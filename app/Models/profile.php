<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'full_name',
        'password',
        'spended',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
