<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{

    public function oagenteorigem(){
        return $this->belongsTo('App\User','agenteOrigem','id');
    }

    public function oagentedestino(){
        return $this->belongsTo('App\User','agenteDestino','id');
    }

  
    
}
