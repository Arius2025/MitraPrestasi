<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'categories'; // ✅ ini benar

    public function lombas()
    {
        return $this->hasMany(Lomba::class, 'category_id');
    }
}
