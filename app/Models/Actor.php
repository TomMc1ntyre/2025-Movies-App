<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    // Allow mass assignment of name //
    protected $fillable = [
        'name',
    ];

    // An actor can belong to many movies //
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
