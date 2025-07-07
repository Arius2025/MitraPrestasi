<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LombaFile extends Model
{
    protected $fillable = ['lomba_id', 'filename'];

    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }
}
