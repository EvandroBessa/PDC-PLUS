<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    public function user(){
        return $this->hasOne('App\User','id');
    }

    public function provincia(){
        return $this->belongsTo('App\Provincia','cidade','id');

    }

    public function opais(){
        return $this->belongsTo('App\Pais','pais','id');
    }
}


