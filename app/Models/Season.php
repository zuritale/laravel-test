<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_number',
        'show_id'
    ];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
