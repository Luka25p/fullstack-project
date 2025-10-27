<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapters';

    protected $fillable = ['title', 'manga_id', 'number', 'user_id'];


    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }

    public function mangaPanels()
    {
        return $this->hasMany(MangaPanels::class, 'chapter_id');
    }

}
