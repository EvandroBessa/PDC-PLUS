@extends('../header')

    @section('content')
        @include('feed/lados/esquerda')
        <h3>{{ $numero }} Pedidos</h3>
        @foreach ($amigos as $amigos )
            
       
        <div class="people-nearby">
            <!--   <div class="google-maps">
               <div id="map" class="map"></div>
             </div>-->
             <div class="nearby-user">
               <div class="row">
                 <div class="col-md-2 col-sm-2">
                   <img src="{{ url('storage/'.$amigos->agentesolicitado->perfil->fotoPerfil) }}" alt="user" class="profile-photo-lg" />
                 </div>
                 <div class="col-md-7 col-sm-7">
                   <h5><a href="#" class="profile-link">{{ $amigos->agentesolicitado->perfil->nome }}</a></h5>
                   <h6><a href="#" class="profile-link">{{ $amigos->agentesolicitado->username }}</a></h6>
             
                 </div>
                 <div id="botaoAmizade{{ $amigos->agentesolicitado->id }}" class="col-md-3 col-sm-3">
                    
                    <button class="btn btn-danger btn-sm pull-right" id="amizade{{ $amigos->agentesolicitado->id }}" onclick="cancelarPedido('{{ $amigos->id }}','{{ $amigos->agentesolicitado->id }}')">Cancelar Pedido</button>
                 </div>
               </div>
             </div>

        </div>
        @endforeach
        
        @include('feed/lados/direita')  
        @include('../footer')
    @endsection