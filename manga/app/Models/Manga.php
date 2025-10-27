<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'descr',
    'image',
    'genre',
    'auth',
    'user_id'
    ];

    public function chapters()
    {
        return $this->hasMany(\App\Models\Chapter::class, 'manga_id');
    }

}

