<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    public function comentarios(){
        return $this->belongsTo('App\Comentario','comentarios_id','id');
    }

    public function respostacomentario(){

        return $this->belongsTo('App\Comentario','resposta_id','id');
    }


 
}
