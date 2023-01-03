<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'name',
        'release_date'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class)->with('episodes');
    }
}
