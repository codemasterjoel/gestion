<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EjeParroquia extends Model
{
     public function eje()
        {
            return $this->belongsTo(Eje::class);
        }
        public function parroquia()
        {
            return $this->belongsTo(Parroquia::class);
        }
}
