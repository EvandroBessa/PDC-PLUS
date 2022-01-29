@extends('../header')

    @section('content')
        @include('feed/lados/esquerda')
    			<h3>{{ $numero }} Amigos</h3>
       
        
          @if($perfil->agente_id==session()->get('id'))
                <h5>Permissão, escolha uma para mudar de : {{ $perfil->permissaoamizade->tipo }}</h5>

                <div id="permissaoMensagem" class="resposta" style="display: none"></div>
        
                <div class="form-group row">
                <select id="permissaoAmizade" name="permissaoAmizade" class="form-control"
                style="width: 25%; font-size:10px; height:30px; margin-bottom:15px; display:inline-block;margin-right:-1" id="permissao_id">
                <option selected value=0>Selecione uma permissão</option>
        
                    @if($perfil->permissaoAmizade!=1) <option value=1>Privado</option>@endif
                    @if($perfil->permissaoAmizade!=2) <option value=2>Amigo</option>@endif
                    @if($perfil->permissaoAmizade!=3) <option value=3>Amigo do Amigo</option>@endif
                    @if($perfil->permissaoAmizadeid!=4) <option value=4>Publica</option>@endif
                </select>
                </div>
          @endif
 <!-- Friend List
    @if($activar!=0 )
            ================================================= -->
            <div class="friend-list">
            	<div class="row">
                @foreach ( $amigos as $amigos )
                @if( $amigos->agentesolicitante->id==session()->get('id'))
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="{{asset('assets/images/covers/1.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="{{ url('storage/'.$amigos->agentesolicitado->perfil->fotoPerfil) }}" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">Amigo(a)</a>
                      	<h5><a href=" {{ route('perfil.visualizar',$amigos->agentesolicitado->id) }}" class="profile-link">{{ $amigos->agentesolicitado->perfil->nome }}</a></h5>
                      
                      	<p>{{ $amigos->agentesolicitado->username }}</p>
                      </div>
                    </div>
                  </div>
                </div>

                @elseif($amigos->agentesolicitado->id==session()->get('id'))
                <div class="col-md-6 col-sm-6">
                  <div class="friend-card">
                  	<img src="{{asset('assets/images/covers/1.jpg')}}" alt="profile-cover" class="img-responsive cover" />
                  	<div class="card-info">
                      <img src="{{ url('storage/'.$amigos->agentesolicitante->perfil->fotoPerfil) }}" alt="user" class="profile-photo-lg" />
                      <div class="friend-info">
                        <a href="#" class="pull-right text-green">Amigo(a)</a>
                      	<h5><a href="{{ route('perfil.visualizar',$amigos->agentesolicitante->id) }}" class="profile-link">{{ $amigos->agentesolicitante->perfil->nome }}</a></h5>
                      
                      	<p>{{ $amigos->agentesolicitante->username }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
            
                
            	
            
            </div>
          </div>

@endif
        @include('feed/lados/direita')  
        @include('../footer')
    @endsection

    
     