<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    public function agente(){
        return $this->belongsTo('App\User','agente_id','id');
    }

    public function permissao(){
        return $this->belongsTo('App\Permissao','permissao_id','id');
    }
    public function permissaoamizade(){
        return $this->belongsTo('App\Permissao','permissaoAmizade','id');
    }
}
