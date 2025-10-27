<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaPanels extends Model
{
    use HasFactory;
    protected $table = 'mangapanels';

    protected $fillable = ['chapter_id', 'path'];

    public function manga()
    {
        return $this->belongsTo(Manga::class);
    }
}

