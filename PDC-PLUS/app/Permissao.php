<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    
    public function publicacao(){
        return $this->hasOne('App\Publicacao','permissao_id','id');
    }
}
