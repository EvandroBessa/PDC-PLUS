<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','telefone','tipo','localizacao_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function publicacao(){
        return $this->hasMany('App\Publicacao','agente_id','id');
    }

    public function pontuacao(){
        return $this->hasMany('App\Pontuacao','agente_id','id');
    }

    public function amigoSolicitante(){
        return $this->hasMany('App\Amigos','agenteSolicitante','id');
    }

    public function amigoSolicitado(){
        return $this->hasMany('App\Amigos','agenteSolicitado','id');
    }

    public function perfil(){
        return $this->hasOne('App\Perfil','agente_id','id');
    }


    public function publica(){
        return $this->belongsToMany('App\Publicacao','App\Comentario','publicacao_id','agente_id','id','id');
    }

    public function localizacao(){
        return $this->belongsTo('App\Localizacao','localizacao_id','id');
    }


    public function mensagem(){
        return $this->hasMany('App\Mensagem','agenteOrigem','id');
    }
    
}
