<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geopunto extends Model
{
    public function parroquia()
    {
        return $this->belongsTo(Parroquia::class);
    }
    public function eje()
    {
        return $this->belongsTo(Eje::class);
    }
    public function comuna()
    {
        return $this->belongsTo(Comuna::class);
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
