@extends('../header')

    @section('content')
        @include('feed/lados/esquerda')
        <div id="conteudos">
 <!-- Chat Room
            ================================================= -->
            <div class="chat-room">
              <div  class="row">
                <div class="col-md-5">

                  <!-- Contact List in Left-->
                  <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">
                    @foreach ($amigos as $amigos )
                        @if($amigos->agenteSolicitado==session()->get('id'))
                  
                        <li class="active">
                          <a href="#contact-1" data-toggle="tab" id="mensagemAmigo{{ $amigos->id }}" onclick="mensagens('{{ $amigos->agenteSolicitante }}')">
                            <div class="contact">
                              <img src="{{ url('storage/'.$amigos->agentesolicitante->perfil->fotoPerfil) }}" alt="" class="profile-photo-sm pull-left"/>
                              <div class="msg-preview">
                                <h6>{{ $amigos->agentesolicitante->perfil->nome }}</h6>
                                @if($amigos->enviomensagemsolicitante_count>0)
                                <div class="chat-alert">{{ $amigos->enviomensagemsolicitante_count }}</div>
                                @endif
                              </div>
                            </div>
                          </a>
                        </li>
                        @else
                        <li class="active">
                          <a href="#contact-1" data-toggle="tab" id="mensagemAmigo{{ $amigos->id }}" onclick="mensagens('{{ $amigos->agenteSolicitado }}','{{ $amigos->id }}')">
                            <div class="contact">
                              <img src="{{ url('storage/'.$amigos->agentesolicitado->perfil->fotoPerfil) }}" alt="" class="profile-photo-sm pull-left"/>
                              <div class="msg-preview">
                                <h6>{{ $amigos->agentesolicitado->perfil->nome }}</h6>
                                @if($amigos->enviomensagemsolicitado_count>0)
                                <div class="chat-alert" id="chat-alert{{ $amigos->id }}">{{ $amigos->enviomensagemsolicitado_count }}</div>
                                @endif
                              </div>
                            </div>
                          </a>
                        </li>
                        @endif()
                    @endforeach
                   
                  </ul><!--Contact List in Left End-->

                </div>
                <div class="col-md-7">

                  <!--Chat Messages in Right-->
                  <div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
                    <div class="tab-pane active" id="contact-1">
                      <div class="chat-body">
                      	<ul class="chat-message" id="chat-message">
              
                          <p> Clique para aceder às mensagens!</p>
                           
 

                         
                      	</ul>
                      </div>
                    </div>


                    
                  </div><!--Chat Messages in Right End-->
                  <input type="hidden" id="agenteDestino">
                  <div class="send-message" style="display: none">
                    <div class="input-group">
                      <input type="text" class="form-control" id="inputEnviarMensagem" placeholder="Escreva a sua mensagem">
                      <span class="input-group-btn">
                        <button class="btn btn-default" id="enviarMensagem" type="button">Enviar</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>

<div>

        @include('feed/lados/direita')  
        @include('../footer')
    @endsection

    
     