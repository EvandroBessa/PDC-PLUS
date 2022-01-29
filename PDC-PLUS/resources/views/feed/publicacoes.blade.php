@foreach ($publicacao as $p)

    <div class="post-content">
      @if ($p->agente_id == session()->get('id'))
      <a href="{{ route('publicacao.eliminar', $p->id) }}" ><i class="icon ion-android-delete" id="g"></i></a>
       
      @endif
      <select name="perm" id="perm">
        <option value="{{ $p->permissao->id }}">{{ $p->permissao->tipo }}</option>
       @if($p->permissao->id!=1)   <option value="1">Privado</option> @endif
        @if($p->permissao->id!=2)  <option value="2">Amigo</option>  @endif
        @if($p->permissao->id!=3)  <option value="3">Amigo de Amigo</option>  @endif
        @if($p->permissao->id!=4) <option value="4">Publica</option>  @endif
      
      </select>
      <input type="hidden" name="minhaPub" id="minhaPub" value="{{ $p->id }}">
      @if ($p->conteudo)
          {{-- Falta-nos a foto <img src="assets/images/post-images/1.jpg"alt="post-image"class="img-responsivepost-image"/> --}}
      @endif
      <div class="post-container">
          <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
          <div class="post-detail">
              <div class="user-info">
                  <h5><a href="timeline.html" class="profile-link">{{{$p->agente->username}}}</a> </h5>
                  <p class="text-muted">Publicado em {{ date('d-m-Y H:i:s', strtotime($p->created_at)) }}</p>

              </div>

              <div class="line-divider">

              </div>
              <div class="post-text">
                  <p id="comentarioPublicado">
                    @if($largacaixa!=" ")
                @foreach($largacaixa as $lg)
                    @if($lg->publicacao_id==$p->id)
                  
                        {{{ $lg->titulo }}}

                        

              <div id="meuIframe{{ $p->unicoId }}" @if($lg->tipo!=1)onmouseover="bloqueado('{{ $p->unicoId }}','{{ $lg->id }}')" @endif >
                          <div class="embed-responsive embed-responsive-4by3 " >
                    
                            <iframe class="embed-responsive-item" frameBorder="2" controls src="{{{url ('storage/'.$lg->endereco)}}}" allowfullscreen sandbox allow="accelerometer;  encrypted-media; gyroscope; picture-in-picture"></iframe>
                        </div>
              </div>

              <div class="" style="width: 350px;height:350px; display:none" id="cadeado{{ $p->unicoId }}" @if($lg->tipo!=1) onmouseout="desbloqueado('{{ $p->unicoId }}')" @endif >  
                <h5>Conteudo Bloqueado compre ou alugue para ter acesso!</h5>         
              <img src="{{{asset ('assets/images/cadiado.png')}}}" style="width:100%;max-height:100%" alt="">
              </div>
                          <br>
                          {{-- <iframe src="{{{url ('storage/'.$lg->endereco)}}}" frameborder="0"></iframe> --}}

                          {{-- -se for pago --}}
                          @if($lg->tipo!=1  and $lg->agente_id!=session()->get('id'))

                          <div id="info{{ $p->unicoId }}">

                          </div>
                       <div style="float: right;">
                        <a id="compra{{ $p->unicoId }}" onclick="pagar('{{ $lg->agente_id }}','{{ session()->get('id') }}','compra','{{{   $lg->preco   }}}','{{ $lg->id }}','{{ $p->unicoId }}')" class="btn btn-warning btn-sm">Comprar</a>
                        <a id="aluguer{{ $p->unicoId }}" onclick="pagar('{{ $lg->agente_id }}','{{ session()->get('id') }}','aluguer','{{{   $lg->preco   }}}','{{ $lg->id }}','{{ $p->unicoId }}')" class="btn btn-info btn-sm">alugar</a>
                       </div>
                     
                     
                       <a>Compra AOA  {{{ number_format($lg->preco,2)  }}}</a>
                       <p><a>Aluguer (1-Semana) AOA  {{{ number_format($lg->preco/5,2)  }}}</a></p>
                         

                         
                         @endif
                     @endif
                  @endforeach
                  @endif
                  {{ $p->legenda }} 
                  </p>

                 
                  <div class="line-divider">

              </div>
              <div id="comentariosPub{{ $p->unicoId }}" style="display: none">
                <input type="text" style="display: none" id="acionador{{ $p->unicoId }}" value="0">
                <div id="comentariospublicacao{{ $p->unicoId }}">


                </div>
                
            </div>
                 
                 {{-- @foreach($p->comentario as $c)
                      <div class="post-comment" id="post-comment{{ $c->unicoId }}">
                        
                          <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-sm" />
                          <a class="profile-link">
                                 
                               
                                              {{ $c->user->username}}
                                       
                                
                                         
                          </a> <p id="texto"><br> {{ $c->texto  }}</p>

                          @if ($p->id == 2)  {{-- Edito os comentarios feitos por mim --

                              <a class="profile-link" id="editar{{ $c->unicoId }}" onclick="editar('{{ $c->unicoId }}','{{ $c->texto }}')" style="margin-left: 5px"><br>editar
                    
                              </a>

                             
                          @endif
                          @if ($p->id != 2)  {{-- -Respondo as mensagens que não foram publicadas por mim --
                             <br> <a class="profile-link" id="responder{{ $c->unicoId }}" onclick="responder('{{ $c->unicoId }}')" style="margin-left: 5px">responder

                                 
                                  <input type="hidden" name="comentarioResposta" id="comentarioResposta" value="2">

                              </a>
                          @endif

                          <div class="respostas" id="respostas{{ $c->unicoId }}">




                        </div>
                      

                      </div>

                      {{-- -----Iput responder----- --
                      <input type="text" class="form-control" name="resposta" id="inputResponder{{ $c->unicoId }}"
                      style="display:none" placeholder="responda aqui">
                      <input type="submit"  class="btn btn-primary btn-sm pull-right" onclick="comentar('{{ $p->unicoId }}','2','{{ $p->id }}','{{ $c->unicoId }}')" id="botaoResponder{{ $c->unicoId }}"
                      style="display:none" value="responder">


                      {{-- -------Input editar----- --
                      <input type="text" class="form-control" style="display:none" name="comentarioId{{ $c->unicoId }}" id="inputEditar{{ $c->unicoId }}" >
                      <input type="submit"  class="btn btn-primary btn-sm pull-right" id="botaoEditar{{ $c->unicoId }}"
                      style="display:none;max-height:34px" onclick="editado('{{ $c->unicoId }}')" value="Editar">
                     
                      @endforeach
                     ---}}






              </div>
              <div class="line-divider" id="line-divider{{ $p->unicoId }}" style="display: none"></div>
            
              <input type="text" class="form-control" style="max-width: 380px; width:100%; display:inline-block" name="comentario" id="comentario{{ $p->unicoId }}"
              placeholder="comente aqui">

             <input type="submit" style="display: inline-block; margin-right:-4px;height:34px;" onclick="comentar('{{ $p->unicoId }}','{{ session()->get('id') }}')" class="btn btn-primary btn-sm pull-right" id="comentar"
             value="comentar">
             <div class="reaction">
              {{-- @if (Auth::user()->id != $publicacao->agente_id) --}}
              <a class="btn text-green" id="numeroComentarios{{ $p->unicoId }}" ><i  onclick="comentariosPublicacao('{{ $p->unicoId }}',null,'{{ session()->get('id') }}')" id="numcom{{ $p->unicoId }}">@if($p->numeroComentarios>0 ) ({{ $p->numeroComentarios }}) Comentarios @endif</i></a>
              <a class="btn text-green" id="gostei{{ $p->unicoId }}" ><i class="icon ion-thumbsup" onclick="pontuar('{{ $p->unicoId }}','1')" id="g{{ $p->unicoId }}">@if($p->positivo>0 or $p->negativo>0){{ $p->positivo }}@endif</i></a>
              <a class="btn text-red" id="naogostei{{ $p->unicoId }}"><i class="fa fa-thumbs-down"  onclick="pontuar('{{ $p->unicoId }}','0')" id="ng{{ $p->unicoId }}">@if($p->positivo>0 or $p->negativo>0){{ $p->negativo }}@endif</i></a>
              {{-- @endif --}}
          </div>
             <div class="comenta{{ $p->unicoId }}"></div>
            

         

          </div>
        
      </div>
  </div>
    @endforeach

