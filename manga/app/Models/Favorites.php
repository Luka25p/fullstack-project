<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'manga_id'];

    // Relationship to Manga
    public function manga()
    {
        return $this->belongsTo(Manga::class, 'manga_id');
    }
}

