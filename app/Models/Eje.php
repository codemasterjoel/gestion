<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eje extends Model
{
    public function parroquias()
    {
        return $this->belongsToMany(Parroquia::class, 'eje_parroquia', 'eje_id', 'parroquia_id');
    }
}
