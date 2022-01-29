<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    public function comentario(){
        return $this->hasMany('App\Comentario','publicacao_id','id')->where('tipo','comentario');
    }

    public function permissao(){
        return $this->belongsTo('App\Permissao','permissao_id','id');
    }

    public function agente(){
        return $this->belongsTo('App\User','agente_id','id');
    }

    public function pontuacao(){
        return $this->hasMany('App\Pontuacao','publicacao_id','id');
    }

    public function pontuadores(){
        return $this->hasManyThrough('App\Pontuacao','App\Publicacao','agente_id','publicacao_id');
    }

    public function userponto(){
        return $this->belongsToMany('App\User','App\Comentario','publicacao_id','agente_id')
        ->withPivot('id');
    }
    public function respostaComentario(){
        return $this->belongsToMany('App\Comentario','App\Comentario','publicacao_id','comentarioResposta_id','id','id');
    }
}
