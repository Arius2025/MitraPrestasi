<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Lomba extends Model
{
    use HasFactory;

    protected $casts = [
        'categories' => 'array',
        
    ];
    protected $fillable = [
        'title',
        'description',
        'categories',
        'registration_date',
        'competition_date',
        'thumbnail',
        'link',
    ];

    public function files()
    {
        return $this->hasMany(LombaFile::class);
    }

    public function kategori()
{
    return $this->belongsTo(Kategori::class, 'category_id');
}
}