<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comentario extends Model
{
    public function publicacao(){
        return $this->belongsTo('App\Publicacao','publicacaos_id','id');
    }


    public function respostaComentarioPublicacao(){
        return $this->belongsToMany('App\Publicacao','App\Comentario','publicacao_id','comentarioResposta_id','id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','agente_id','id');
    }

    public function respostas(){
        return $this->hasMany('App\Resposta','comentarios_id','id');
    }

    public function respostacomentarios(){
        return $this->belongsTo('App\Resposta','resposta_id','id');
    }
}
