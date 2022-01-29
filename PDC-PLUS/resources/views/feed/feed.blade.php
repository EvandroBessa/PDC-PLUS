@extends('../header')

@section('content')

    @include('feed/lados/esquerda')
  <div id="conteudos">

  {{--
   
    <a href="{{ route('publicacao.conteudo.visualizar') }}" class="btn btn-primary btn-lg">visualizar Conteudo</a>
 -----------mODAL mENSAGEM---------------------- --}}
<div class="create-post">
<div class="col-md-12 ">
    @if(session()->has('resposta'))
<div class="alert alert-success  show mensagem" role="alert" style=" width:100%;">
    <h5> {{session()->get('resposta') }}</h5>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif
  <div class="alert alert-success   mensagem" id="modalMensagem" style="display: none; width:100%;">
    Publicação Efectuada com Sucesso
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  
</div>


</div>


{{-- ------------------------------------------------------- --}}
    <div class="create-post">
        <!-- Button trigger modal -->
      

        <div class="col-md-12 ">
            <center> <button type="button" id="publicarTextoBt" class="btn btn-primary btn-lg" style="width:100%" data-toggle="modal"
                    data-target="#modalTexto">
                    Publique uma nota Textual! 
                </button></center>
        </div>

        <div class="col-md-12">
            <center> <button type="button" id="publicarConteudoBt" class="btn btn-primary btn-lg"
                    style="width:100%; background-color:#8dc63f; margin-top:10px; color:white" data-toggle="modal"
                    data-target="#modalConteudo">
                    Publique um Conteudo! 
                </button></center>
        </div>
    </div>
    <!-- Modal  Texto-->
    <div class="modal fade" id="modalTexto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" id="closeModelTexto" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Efectuar uma Publicação</h4>
                </div>
                <div class="modal-body" style="max-height:250px; height: 250px; ">
 
                    <div class="form-group" style="max-height:200px; height: 100%; ">
                        <select name="permissao_id" class="form-control" style="width: 25%; font-size:10px; height:30px "
                            id="permissao_id">
                            <option selected value=0>Quem pode ver?</option>
                            <option value="1">Privado</option>
                            <option value="2">Amigo</option> 
                            <option value="3">Amigo do Amigo</option>
                            <option value="4">Publica</option>
                        </select>
                        <textarea name="legenda" id="legenda" style=" width: 100%; height:100%; max-height:250px; "
                            class="form-control" placeholder="Escreva o que sentes"></textarea>
                        <input type="hidden" name="tipo" id="tipo" value="1">


                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-lg" disabled style="width: 100%"  data-dismiss="modal"
                        id="publicarModal">Publicar</button>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal Conteudo -->
    <div class="modal fade" id="modalConteudo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" action="{{ route('publicacao.conteudo') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" id="closeModelConteudo" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Efectuar uma Publicação</h4>
                </div> 
                <div class="modal-body" style="height:150px">
        
                    <div class="form-group">

                        <select name="permissao" class="form-control"
                            style="width: 25%; font-size:10px; height:30px; margin-bottom:15px; display:inline-block;margin-right:-1" id="permissao_id">
                            <option selected value=0>Quem pode ver?</option>
                            <option value="1">Privado</option>
                            <option value="2">Amigo</option>
                            <option value="3">Amigo do Amigo</option>
                            <option value="4">Publica</option>
                        </select>
                        <select name="tipo" id="tipoConteudo" class="form-control"
                        style="width: 25%; font-size:10px; height:30px; margin-bottom:15px; display:inline " id="permissao_id">
                        <option selected value="1">Gratis</option>
                        <option value="2">Pago</option>
                    </select>

                    <input type="text" class="form-control" placeholder="titulo" required  style="width: 25%; font-size:10px; height:30px; margin-bottom:15px;display:inline-block;margin-right:-2 " name="titulo" >
                    <input type="text" class="form-control" placeholder="Defina o Preço" id="precoConteudo"   style="width: 25%; font-size:10px; height:30px; margin-bottom:15px;display:none " name="preco" >

                        <center><input type="file" class="btn  btn-lg" required style="background-color: #8dc63f; width:100%"
                          name="conteudo" id="conteudo" aria-placeholder="Publique um Conteudo" accept="image/*,.pdf,.MP3,.MP4"></center>
                    </div>
                 
                    
                    

                 
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-lg" style="width: 100%" 
                        id="publicarConteudo" value="Publicar">
                </div>
       
              </form>
            </div>
         
        </div>
    </div>



































    <!-- Post Content
                ================================================= -->
    {{--@foreach ($publicacao as $p)
    <div class="post-content">
      @if ($p->agente_id == 2)
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
          {{-- Falta-nos a foto <img src="assets/images/post-images/1.jpg"alt="post-image"class="img-responsivepost-image"/> -
      @endif
      <div class="post-container">
          <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
          <div class="post-detail">
              <div class="user-info">
                  <h5><a href="timeline.html" class="profile-link">{{ $p->agente->username }}</a> </h5>
                  <p class="text-muted">Publicado em {{ date('d-m-Y H:i:s', strtotime($p->created_at)) }}</p>

              </div>

              <div class="line-divider">

              </div>
              <div class="post-text">
                  <p id="comentarioPublicado">{{ $p->legenda }} </p>

                  <div class="reaction">
                    {{-- @if (Auth::user()->id != $publicacao->agente_id) --
                    <a class="btn text-green" id="numeroComentarios{{ $p->unicoId }}" ><i  onclick="comentariosPublicacao('{{ $p->unicoId }}',null,'2')" id="numcom{{ $p->unicoId }}">@if($p->numeroComentarios>0 ) ({{ $p->numeroComentarios }}) Comentarios @endif</i></a>
                    <a class="btn text-green" id="gostei{{ $p->unicoId }}" ><i class="icon ion-thumbsup" onclick="pontuar('{{ $p->unicoId }}','1')" id="g{{ $p->unicoId }}">@if($p->positivo>0 or $p->negativo>0){{ $p->positivo }}@endif</i></a>
                    <a class="btn text-red" id="naogostei{{ $p->unicoId }}"><i class="fa fa-thumbs-down"  onclick="pontuar('{{ $p->unicoId }}','0')" id="ng{{ $p->unicoId }}">@if($p->positivo>0 or $p->negativo>0){{ $p->negativo }}@endif</i></a>
                    {{-- @endif --
                </div>
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
                     ---






              </div>
              <div class="line-divider" id="line-divider{{ $p->unicoId }}" style="display: none"></div>
              <input type="text" class="form-control" style="max-width: 380px; width:100%; display:inline-block" name="comentario" id="comentario{{ $p->unicoId }}"
              placeholder="comente aqui">

             <input type="submit" style="display: inline-block; margin-right:-4px;height:34px;" onclick="comentar('{{ $p->unicoId }}','2')" class="btn btn-primary btn-sm pull-right" id="comentar"
             value="comentar">
             <div class="comenta{{ $p->unicoId }}"></div>
            

         

          </div>
        
      </div>
  </div>
    @endforeach--}}
   
   
 
    <div id="post-data">
        @include('feed.publicacoes') 
    </div>
  

 

   

<div class="ajax-load text-center" style="display: none">
    <p> A Carregar mais publicações</p>

</div>
</div>
    <script src="assets/js/jquery-3.1.1.min.js"></script>
    <script>
function header(){

 return   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

    },
});

}


function pontuar(unicoId,val) {

var caminho = "{{ route('publicacao.pontuacao') }}";



var agente = {{ session()->get('id') }}; ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
// var publicacao = 2; ///aqui  deve conter o id da publicação  


header()
$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
        valor: val,
        agente_id: agente,
        publicacao: unicoId

    },
    success: function(data) {

        variavel = JSON.parse(data)
        console.log(variavel)

        $('#g'+unicoId).html( variavel.positivo )
        $('#ng'+unicoId).html( variavel.negativo )
        // console.log(variavel.pop())

        //  $("tbody").hide()





    }


})



}



function comentar(unicoId,agente,respostaUnicoId=null){

    var dado = $('#comentario'+unicoId).val();

    if(dado.replace(/\s+/g, '').length != 0){

                    var caminho = "{{ route('publicacao.comentar') }}";
                    var dado = $('#comentario'+unicoId).val();
                    if(respostaUnicoId){
                        dado = $('#inputResponder'+respostaUnicoId).val();
                    }
                  //  var agente = 3; ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
                   // var publicacao = 2; ///aqui  deve conter o id da publicação  
                //   header()









                    $.ajax({

                        method: "GET",
                        enctype: 'multipart/form-data',
                        url: caminho,
                        data: {

                            dado: dado,
                            publicacao: unicoId,
                            agente: agente,
                            comentarioResposta:respostaUnicoId
                        },
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        success: function(data) {
                            console.log(data)
                            variavel = JSON.parse(data)
                            $('#comentario').val('')
                            $('#comentario'+unicoId).val('');
                            //  $("tbody").hide()
                      
                             $('#acionador'+unicoId).val("0")
                             comentariosPublicacao(unicoId,"nova",agente)
                             if(respostaUnicoId!=null){
                                $('#acionadorComentario'+respostaUnicoId).val("0") 
                                 respostas(respostaUnicoId)
                                return 
                             



                               //  respostas(respostaUnicoId)

                                /*$('#respostasComentario'+respostaUnicoId).css("display","block")
                                        $('#respostasComentario'+respostaUnicoId+'> #respcom').prepend(`
                                        <p>
                                        <div class="post-comment" id="post-comment`+variavel.unicoId+`">
                                    
                                                <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-sm"/>
                                                <a class="profile-link">    
                                                    
                                                                    `+variavel.user.username+` 
                                                            
                                                    
                                                            
                                                </a><p id="texto"><br> `+variavel.texto+`</p>

                                    
                                        </div>
                                        </p>
                                        `)

                                        return*/
                             }

                 
                       /*     $('.comenta'+unicoId).prepend(`

                            <div class="post-comment" id="post-comment`+variavel.unicoId+`">
                        
                        <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-sm" />
                        <a class="profile-link">    
                             
                                            `+variavel.user.username+`
                                     
                              
                                       
                        </a><p id="texto"><br> `+variavel.texto+`</p>

                                           
                    
                           <a class="profile-link" id="editar`+variavel.unicoId+`" onclick="editar('`+variavel.unicoId+`','`+variavel.texto+`')" style="margin-left: 5px"><br>editar
                    
                  </a>
     

                    </div>
                    
                  <input type="text" class="form-control" style="display:none" name="comentarioId`+variavel.unicoId+`" id="inputEditar`+variavel.unicoId+`" >
                  <input type="submit"  class="btn btn-primary btn-sm pull-right" id="botaoEditar`+variavel.unicoId+`"
                  style="display:none;max-height:34px" onclick="editado()" value="editar">
                  
                            
                            `)


*/


                        }


                    })

                }




                

         



}







function respostas(unicoId){








    var caminho = "{{ route('publicacao.comentario.respostas') }}";

    if( $('#acionadorComentario'+unicoId).val()=="1"){
    $('#respostasComentario'+unicoId).css("display","none")
    $('#responderDown'+unicoId).css("display","none")
    $('#numeroRespostas'+unicoId).css("color","#27aae1")
    $('#acionadorComentario'+unicoId).val("2") 

    return ' '

}else if($('#acionadorComentario'+unicoId).val()=="2"){
    $('#respostasComentario'+unicoId).css("display","block")
    $('#responderDown'+unicoId).css("display","block")
    $('#numeroRespostas'+unicoId).css("color","red")
    $('#acionadorComentario'+unicoId).val("1")

    return ' '
   
}



header()
$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
   
        comentario: unicoId

    },
    success: function(data) {

        variavel = JSON.parse(data)
        console.log(variavel)
        
     
        $('#respostasComentario'+unicoId).css("display","block")
            $('#numeroRespostas'+unicoId).css("color","red")
            $('#acionadorComentario'+unicoId).val("1")
            $('#responderDown'+unicoId).css("display","block")

        for(let i=0; i<variavel.respostas.length;i++){



        $('#respostasComentario'+unicoId+'> #respcom').prepend(`
<p>
        <div class="post-comment" id="post-comment`+variavel.respostas[i].respostacomentario.unicoId+`">
    
    <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-sm"/>
    <a class="profile-link">    
         
                        `+variavel.respostas[i].respostacomentario.user.username+` 
                 
          
                   
    </a><p id="texto"><br> `+variavel.respostas[i].respostacomentario.texto+`</p>

    
        </div>
    </p>
        `)
       

    }

 


    }



    })


}















function comentariosPublicacao(unicoIdPublicacao,nova=null,agente=null){

    

    var caminho = "{{ route('publicacao.comentarios') }}";

if( $('#acionador'+unicoIdPublicacao).val()=="1"){
    $('#comentariosPub'+unicoIdPublicacao).css("display","none")
    $('#line-divider'+unicoIdPublicacao).css("display","none")
    $('#acionador'+unicoIdPublicacao).val("2")
    return
}else if($('#acionador'+unicoIdPublicacao).val()=="2"){
    $('#comentariosPub'+unicoIdPublicacao).css("display","block")
    $('#line-divider'+unicoIdPublicacao).css("display","block")
    $('#acionador'+unicoIdPublicacao).val("1")
    return
   
}
                
                  //  var agente = 3; ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
                   // var publicacao = 2; ///aqui  deve conter o id da publicação  
                   header()






                    $.ajax({

                        method: "GET",
                        enctype: 'multipart/form-data',
                        url: caminho,
                        data: {

                            publicacao: unicoIdPublicacao,
                        
                        },
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        success: function(data) {
                            console.log(data)
                            variavel = JSON.parse(data)
                            $('#comentariospublicacao'+unicoIdPublicacao).html('')
                          $('#line-divider'+unicoIdPublicacao).css("display","block")
                            //  $("tbody").hide()
                        $('#comentariosPub'+unicoIdPublicacao).css("display","block")
                        $('#acionador'+unicoIdPublicacao).val("1")
                        if(nova!=null){
                            $('#numcom'+unicoIdPublicacao).html(`(`+variavel.numero+`) Comentarios`)
                        }

                           


                for(let i=0; i<=variavel.comentarios.length;i++){

                    var editar= `<a class="profile-link" id="editar`+variavel.comentarios[i].unicoId+`" onclick="editar('`+variavel.comentarios[i].unicoId+`','`+variavel.comentarios[i].texto+`')" style="margin-left: 5px"><br>editar</a>
    
                    `
                    var inputEditar= `<input type="text" class="form-control" style="display:none" name="comentarioId`+variavel.comentarios[i].unicoId+`" id="inputEditar`+variavel.comentarios[i].unicoId+`" >
                  <input type="submit"  class="btn btn-primary btn-sm pull-right" id="botaoEditar`+variavel.comentarios[i].unicoId+`"
                  style="display:none;max-height:34px" onclick="editado('`+variavel.comentarios[i].unicoId+`')" value="editar">`


                  var responder =`<br> <a class="profile-link " id="responder`+variavel.comentarios[i].unicoId+`" onclick="responder('`+variavel.comentarios[i].unicoId+`')" style="margin-left: 5px">responder
                                            </a>`

                var responderDown =`<br> <a class="profile-link" id="responderDown`+variavel.comentarios[i].unicoId+`" onclick="responder('`+variavel.comentarios[i].unicoId+`')" style="margin-left: 5px;display:none">responder
                                            </a>`
                var inputResponder = ` <input type="text" class="form-control" name="resposta" id="inputResponder`+variavel.comentarios[i].unicoId+`"
                      style="display:none" placeholder="responda aqui">
                      <input type="submit"  class="btn btn-primary btn-sm pull-right" onclick="comentar('`+unicoIdPublicacao+`','`+agente+`','`+variavel.comentarios[i].unicoId+`')" id="botaoResponder`+variavel.comentarios[i].unicoId+`"
                      style="display:none" value="responder">`
                    var numeroRespostas = `<br> <a class="profile-link" id="numeroRespostas`+variavel.comentarios[i].unicoId+`" onclick="respostas('`+variavel.comentarios[i].unicoId+`')" style="margin-left: 5px">(`+variavel.comentarios[i].respostas_count+`) respostas
                                            </a>` 
                    if(variavel.comentarios[i].respostas_count == 0){
                        numeroRespostas=" "
                    }
                            if(variavel.comentarios[i].user.id==agente){
                           editar = " "
                             inputEditar = " "
                            }else{
                                responder=" "
                                inputResponder = " "
                            }

                            $('#comentariospublicacao'+unicoIdPublicacao).prepend(`

                            <div class="post-comment" id="post-comment`+variavel.comentarios[i].unicoId+`">
                        
                        <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-sm" />
                        <a class="profile-link">    
                             
                                            `+variavel.comentarios[i].user.username+`
                                     
                              
                                       
                        </a><p id="texto"><br> `+variavel.comentarios[i].texto+`</p>

                                `+responder+`
                                           
                                `+editar+`
                               
                            </div>
                            <div id="respostasComentario`+variavel.comentarios[i].unicoId+`" style="display:none;margin-left:10%">
                                    <p id="respcom"></p>
                             
                            </div>

                            <input type="text" style="display:none" id="acionadorComentario`+variavel.comentarios[i].unicoId+`" value="0">

                            `+numeroRespostas+``+responderDown+`
                            `+inputResponder+`
                            `+inputEditar+`
                            `)
                           

                        }

                     


                        }


                    })

              


}


function editar(editarId,texto=null){

if($('#inputEditar'+editarId).css("display")=="block"){
        $('#inputEditar'+editarId).css("display","none")
        $('#botaoEditar'+editarId).css("display","none")
        $('#editar'+editarId).css("color","#27aae1")
        $('#editar'+editarId).html('<br>editar')

}else{

        $('#inputEditar'+editarId).css("display","block")
        $('#botaoEditar'+editarId).css("display","block")
        $('#inputEditar'+editarId).val(texto)
        $('#editar'+editarId).html('<br>Fechar Edição')
        $('#editar'+editarId).css("color","red")




}




       




}












function editado(comentarioUnicoId){






            ////Editar Comentario

           

//var comentarioId = $('#editar > #comentarioId').val()
var caminho = "{{ route('publicacao.comentario.editado') }}";
//caminho = caminho.replace('comentario', comentarioId)
dado = $('#inputEditar'+comentarioUnicoId).val()
///não pode estar vazio
if(dado.replace(/\s+/g, '').length != 0){
// var dado= $('#comentario').val();
//  var agente= 3;   ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
// var publicacao=2; ///aqui  deve conter o id da publicação  
header()






$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data:{
      dado:dado,
      comentario:comentarioUnicoId
    },
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    success: function(data) {
        console.log(data)
        variavel = JSON.parse(data)
        $('#inputEditar'+comentarioUnicoId).val('')
editar(comentarioUnicoId);


     $('#post-comment'+comentarioUnicoId+' > #texto').html('<br>'+variavel.texto)


    }


})




}


















}

function responder(responderId){

  if($('#inputResponder'+responderId).css("display")=="block"){
        $('#inputResponder'+responderId).css("display","none")
        $('#botaoResponder'+responderId).css("display","none")
        $('#responder'+responderId).css("color","#27aae1")
        $('#responder'+responderId).html('responder')
        $('#responderDown'+responderId).html("responder")
        $('#responderDown'+responderId).css("color","#27aae1")

}else{

        $('#inputResponder'+responderId).css("display","block")
        $('#botaoResponder'+responderId).css("display","block")
        $('#responder'+responderId).html('Fechar Resposta')
        $('#responderDown'+responderId).html("Fechar Resposta")
        $('#responder'+responderId).css("color","red")
        $('#responderDown'+responderId).css("color","red")




}
                

}



function resposta(comentarioUnicoId,dado,agente,publicacao){

    
var caminho = "{{ route('publicacao.comentario.responder') }}";


// var dado= $('#comentario').val();
//  var agente= 3;   ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
// var publicacao=2; ///aqui  deve conter o id da publicação  
header()






$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
        dado: dado,
        comentarioResposta_id: comentarioUnicoId,
        agente: agente,
        publicacao: publicacao

    },
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    success: function(data) {
        console.log(data)
        variavel = JSON.parse(data)


       



    }


})







}











//////Mais publicações



function maisPublicacoes(page){


  //  var caminho = "http://127.0.0.1:8000/";
$.ajax({



url: '?page='+page,
type: "get",
beforeSend:function(){
    $('.ajax-load').show();

},

})
.done( function(data) {
   // console.log(data.html)
    if(data.html.length ==0){
        $('.ajax-load').html("Já não tens publicações");
        return;
    }

    $('.ajax-load').hide();
    $('#post-data').append(data.html);

   
})
.fail(function(jqXHR,ajaxOptions,thrownError){
    alert("Servidor não  está respondendo... ");
});



}











var page = 1
$(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height()+1500 >= $(document).height()) {
                    page++;
                    //alert("porra")
                   // console.log(page)
                   // console.log($(window).scrollTop() + $(window).height())
                   // console.log( $(document).height())
                    maisPublicacoes(page);
 }
 
 })






function bloqueado(unicoidPublicacao,conteudo){

   

    
    var caminho = "{{ route('publicacao.verificarConteudo') }}";


// var dado= $('#comentario').val();
//  var agente= 3;   ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
// var publicacao=2; ///aqui  deve conter o id da publicação  
header()






$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    success: function(data) {
        console.log(data)
        variavel = JSON.parse(data)
        var n=0;
        for(let i=0; i<variavel.length;i++){
            if(variavel[i].id==conteudo){
              n=1
            }

        }
        if(n==0){
            $('#meuIframe'+unicoidPublicacao).hide();
                $('#cadeado'+unicoidPublicacao).show();
        }
      
    }


})


    
}

function desbloqueado(unicoidPublicacao){

$('#meuIframe'+unicoidPublicacao).show();
$('#cadeado'+unicoidPublicacao).hide();


}


function pagar(vendedor,comprador,tipo,valor,conteudo,publicacao){
    
    
var caminho = "{{ route('pagamentos.pagar') }}";


// var dado= $('#comentario').val();
//  var agente= 3;   ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
// var publicacao=2; ///aqui  deve conter o id da publicação  
header()






$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
        comprador: comprador,
        vendedor: vendedor,
        valor: valor,
        conteudo: conteudo,
        tipo:tipo

    },
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    success: function(data) {
        console.log(data)
        variavel=JSON.parse(data)
        if(variavel.numero==200){
            $('#info'+publicacao).html(`<p class="sucesso">`+variavel.mensagem+`</p>`)
            $('#cadeado'+publicacao).remove();
            $('#meuIframe'+publicacao).removeAttr('onmouseover');
            if(tipo=="compra"){
                $('#compra'+publicacao).hide()
                $('#aluguer'+publicacao).hide()
            }else{
              
                $('#aluguer'+publicacao).hide()
            }
        }else{
            $('#info'+publicacao).html(`<p class="erroConteudo">`+variavel.mensagem+`</p>`)
        }
        
       


       



    }


})





}












        $('document').ready(function() {




$('#modalTexto').on('shown.bs.modal', function (e) {
  $('#modalTexto').css("display","block");
  $('body').addClass("model-open")
});

$('#closeModelTexto').on('click',function(){
    $('#modalTexto').css("display","none");
});
$('#legenda').on('keyup', function() {
    if ($('#legenda').val().replace(/\s+/g, '').length != 0){
    $('#publicarModal').prop("disabled",false);
        }else{
            $('#publicarModal').prop("disabled",true);
        }
});

$('#modalConteudo').on('shown.bs.modal', function (e) {
  $('#modalConteudo').css("display","block");
  $('body').addClass("model-open")
});
$('#closeModelConteudo').on('click',function(){
    $('#modalConteudo').css("display","none");
});







$('#publicarModal').on('keyup', function() {

    
if ($('#legenda').val().replace(/\s+/g, '').length != 0 ) {
    $('#modalTexto').css("display","none");
var caminho = "{{ route('publicacao.publicar') }}";
var dado = $('#legenda').val();
var tipo = $('#tipo').val();
var permissao = $('#permissao_id').val();

if (permissao == 0) {
    permissao = 4;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

    },
});






$.ajax({

    method: "POST",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
        dado: dado,
        tipo: tipo,
        permissao: permissao,
    },

    success: function(data) {
        console.log(data)
    //    variavel = JSON.parse(data)
    $('#modalTexto').css("display","none");
        $('#legenda').val('');
        $('#permissao_id').val(0)
        $('#publicar').attr('disabled', true)
        $('#modalMensagem').show()
        setTimeout(function(){location.reload()}, 3000);
    

    }


})




}

})












$('#tipoConteudo').on('change',function(){

if($('#tipoConteudo').val()=="2"){
   
    $("#precoConteudo").css("display","inline-block");
}
if($('#tipoConteudo').val()=="1"){
    $("#precoConteudo").css("display","none");
}
})


  //alert($(window).scrollTop() +1500+ $(window).height()+"/////"+ $(document).height())

            //////////////////////comentar

            







            ////Editar Responder

            $('#responder').on('click', function() {


                $('#responder > #resposta').css('display', 'block')
                $('#responder > #responderBotao').css('display', 'block')
            })


            ////////////////////////////////////////////////ALTERAR pERMISSÃO SE O USER FOR O DONO DA PUBLICAÇÃO

            $('#perm').on('change', function() {


                var caminho = "{{ route('publicacao.alterarPermissao') }}";
                var permissao = $('#perm').val()
                console.log(permissao)
                var publicacao = $('#minhaPub').val()
                console.log(publicacao)

                // var dado= $('#comentario').val();
                //  var agente= 3;   ///aqui deve ter o id user e não deve ser a publicção do mesmo user.
                // var publicacao=2; ///aqui  deve conter o id da publicação  
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });






                $.ajax({

                    method: "GET",
                    enctype: 'multipart/form-data',
                    url: caminho,
                    data: {
                        permissao: permissao,
                        id: publicacao

                    },
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    success: function(data) {
                        console.log(data)


                        //  $("tbody").hide()

                        //  <input type="text" style="display: block" class="form-control" name="" value id="comentarioResposta">
                        //  <input type="submit" class="btn btn-primary btn-sm pull-right" id="comentarResposta" value="Comentar">



                    }


                })






            })



            /////////////////////////////////////Publicar TExto//////////////////////////////////


            $('#publicarModal').on('click', function() {


                if ($('#legenda').val() != '') {

                    var caminho = "{{ route('publicacao.publicar') }}";
                    var dado = $('#legenda').val();
                    var tipo = $('#tipo').val();
                    var permissao = $('#permissao_id').val();

                    if (permissao == 0) {
                        permissao = 4;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                        },
                    });






                    $.ajax({

                        method: "POST",
                        enctype: 'multipart/form-data',
                        url: caminho,
                        data: {
                            dado: dado,
                            tipo: tipo,
                            permissao: permissao,
                        },

                        success: function(data) {
                            console.log(data)
                        //    variavel = JSON.parse(data)
                            
                            $('#legenda').val('');
                            $('#permissao_id').val(0)
                            $('#publicar').attr('disabled', true)
                            $('#modalMensagem').css("display","block")
                            setTimeout(function(){location.reload()}, 2000);
                          //  location.reload();
                          
                            

                            /*
                              $('.post-content').html(
                                `<a href="{{ route('publicacao.eliminar', 5) }}" class="btn btn-danger btn-sm">Eliminar</a>
                          <div class="post-container">  
                            <img src="assets/images/users/user-5.jpg" alt="user" class="profile-photo-md pull-left" />
                            <div class="post-detail">
                              <div class="user-info">
                                <h5><a href="timeline.html" class="profile-link">Alexis Clark</a> <span class="following">following</span></h5>
                                <p class="text-muted">Publicado em `+variavel.created_at+`</p>  
                              
                              </div>
                              
                              <div class="line-divider">

                              </div>
                              <div class="post-text">
                                <p id="comentarioPublicado">`+variavel.legenda+`<i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                            </div>

                            <div class="reaction">
                              
                                    <a class="btn text-green" id="gostei"><i class="icon ion-thumbsup" id="g"></i></a>
                                    <a class="btn text-red" id="naogostei"><i class="fa fa-thumbs-down" id="ng"></i></a>

                              </div>
                          </div>
                        </div>`


                              )*/




                        }


                    })




                }

            })






























        })



    </script>

    @include('feed/lados/direita')
    @include('../footer')
@endsection
