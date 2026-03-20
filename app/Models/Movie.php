<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'genre',
        'release_year',
        'director',
        'rating',
        'duration_minutes',
    ];

    protected $casts = [
        'release_year'     => 'integer',
        'rating'           => 'float',
        'duration_minutes' => 'integer',
    ];
}
