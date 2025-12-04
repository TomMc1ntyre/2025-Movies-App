<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'release_year',
        'cover',
        'genre',
        'award',
    ];

    // A movie can have many actors //
    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }



}
