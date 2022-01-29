<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pontuacao extends Model
{
    public function agente(){
        return $this->belongsTo('App\User','agente_id','id');
    }

    public function publicacao(){
        return $this->belongsTo('App\Publicacao','publicacao_id','id');
    }

    
}
