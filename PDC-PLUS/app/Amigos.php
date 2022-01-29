<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amigos extends Model
{ 
    public function agentesolicitante(){
        return $this->belongsTo('App\User','agenteSolicitante','id');
    }

    public function agentesolicitado(){
        return $this->belongsTo('App\User','agenteSolicitado','id');
    }

    public function enviomensagemsolicitante(){
        return $this->hasMany('App\Mensagem','agenteOrigem','agenteSolicitante')->where('agenteDestino',session()->get('id'));
    }
    public function enviomensagemsolicitado(){
        return $this->hasMany('App\Mensagem','agenteOrigem','agenteSolicitado')->where('agenteDestino',session()->get('id'));
    }

    public function recebemensagemsolicitante(){
        return $this->hasMany('App\Mensagem','agenteDestino','agenteSolicitante')->where('agenteOrigem',session()->get('id'));
    }

    public function recebemensagemsolicitado(){
        return $this->hasMany('App\Mensagem','agenteDestino','agenteSolicitado')->where('agenteOrigem',session()->get('id'));
    }
}
