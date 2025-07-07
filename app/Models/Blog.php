<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'content', 'thumbnail', 'published_at'];
    protected $casts = [
        'batas_akhir' => 'datetime',
    ];
    use HasFactory;
}
