<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'user_id',
        'rate',
    ];
}
