<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'director_id',
        'genre_id',
        'name',
        'release_date'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movies_actors');
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
