<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trailer extends Model
{
    public function libro (){
        return $this->belongsTo(Libro::class);
    }
}
