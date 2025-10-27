<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Community extends Model
{
    use HasFactory;
    protected $table = 'community';

    protected $fillable = [
        'title',
        'descr',
        'author',
        'user_id',
    ];

    // Automatically delete image when post is deleted
    protected static function booted()
    {
        static::deleting(function ($community) {
            if ($community->image && Storage::disk('public')->exists($community->image)) {
                Storage::disk('public')->delete($community->image);
            }
        });
    }
    public function post()
    {
        return $this->hasMany(\App\Models\Community::class, 'user_id'); 
    }
}
