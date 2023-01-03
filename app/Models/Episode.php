<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'director_id',
        'episode_number',
        'name',
        'season_id'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'episodes_actors');
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class)->with('show');
    }
}
