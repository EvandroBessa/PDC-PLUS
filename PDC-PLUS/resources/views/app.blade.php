<!DOCTYPE html>
<html lang="en">
	<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>PDC-PLUS</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css') }}" />
    <link href="{{asset('assets/css/emoji.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css') }}" />
    <!--Google Webfont-->
		<!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/images/fav.png') }}"/>
    <script src="{{asset('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    
	</head>
	<style>

    .meuIframe:hover{
    
      background-color: rgba(214, 39, 39, 0.815);
        background-image: url("../images/cadiado.png");

    }
    .sucesso{
      color: rgb(0, 119, 255);
    }

    .erroConteudo{
      background-color: rgb(241, 232, 232);
      color:black;
    }
		.error{
	
      background-color: red;
		}

    .eliminado{
      background-color: rgba(240, 157, 2, 0.767);
      color: aliceblue;
    }

    .invalid-feedback{
      color: red;
    }



      .register{
		  margin-right:10%;
		  margin-left: 10%; 
        padding-top: 100px;
        padding-bottom: 20px;
        background-color: white;
        border-radius: 1%;
      }
   

    .efectuarPagamento{
      margin:  ;
    }

    .profilePrint{
		margin-top: 40px;
		height: 100px;
		
	}

  .resposta{
    background-color: aqua;
    
    color: white;
    height: 40px;
    width: 250px;
  }
  </style>
	<body>

  

    @section('sidebar')

    @show
    <div id="page-contents">
        <div class="container">
            @yield('content')
        </div>
    </div>

        
    <script>

        $('#fecharVisualizarPagamento').on('click',function(){
  $('#visualizarPagamento').html('');

})
function visualizarPagamento(idPagamento){
  var caminho = "{{ route('pagamento.visualizar') }}";
  var agente= {{ session()->get('id') }};

$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       id: idPagamento,
      
      

    },
    success: function(data) {

     
        console.log(data)
        variavel = JSON.parse(data)
        $('#visualizarPagamento').html(`
        <br><br><br>
        <a class="btn btn-danger btn-sm" id="fecharVisualizarPagamento" style="float:right">Fechar</a>
        
        <p>Agente Comprador: `+variavel.agenteComprador.nome+`</p>
        <p>Agente Vendedor: `+variavel.agenteVendedor.nome+`</p>
        <p>Titulo: `+variavel.conteudo.titulo+`</p>
        <p>Preço: `+variavel.pagamento.valor+`</p>
        <p>Tipo: `+variavel.pagamento.tipo+`</p>
        <p>Data: `+variavel.pagamento.created_at+`</p>

        
        `)
   
        

    }






})

}
function cancelarPedido(pedido,agenteSolicitado){
  var caminho = "{{ route('conta.cancelarPedidoAmizade') }}";
  var agente= {{ session()->get('id') }};

$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       pedido: pedido,
      
      

    },
    success: function(data) {

     
        console.log(data)
        $('#botaoAmizade'+agenteSolicitado).html(` <button class="btn btn-primary btn-sm pull-right" id="amizade`+agenteSolicitado+`" onclick="amizade('`+agente+`','`+agenteSolicitado+`')">Pedir Amizade</button>`)
       /* $('#amizade'+agenteSolicitado).html('Cancelar Pedido')
        $('#amizade'+agenteSolicitado).attr('class','btn btn-danger btn-sm pull-right');*/
        //document.getElementById('#amizade'+agenteSolicitado).className='btn btn-danger pull-right';
        

    }






})
}




function rejeitarPedido(pedido,agenteSolicitante){
  var caminho = "{{ route('conta.cancelarPedidoAmizade') }}";
  var agente= {{ session()->get('id') }};

$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       pedido: pedido,
      },
    success: function(data) {
     
        console.log(data)
        $('#botaoAmizade'+agenteSolicitante).html(` <button class="btn btn-primary btn-sm pull-right" id="amizade`+agenteSolicitante+`" onclick="amizade('`+agente+`','`+agenteSolicitante+`')">Pedir Amizade</button>`)
       /* $('#amizade'+agenteSolicitado).html('Cancelar Pedido')
        $('#amizade'+agenteSolicitado).attr('class','btn btn-danger btn-sm pull-right');*/
        //document.getElementById('#amizade'+agenteSolicitado).className='btn btn-danger pull-right';
        

    }






})
}







function aceitarPedido(pedido,agenteSolicitante){
  var caminho = "{{ route('conta.aceitarPedidoAmizade') }}";
  var agente= {{ session()->get('id') }};

$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       pedido: pedido,
      },
    success: function(data) {
     
        console.log(data)
        $('#botaoAmizade'+agenteSolicitante).html(` <p class="btn btn-primary btn-sm pull-right"">Amigos</p>`)
       /* $('#amizade'+agenteSolicitado).html('Cancelar Pedido')
        $('#amizade'+agenteSolicitado).attr('class','btn btn-danger btn-sm pull-right');*/
        //document.getElementById('#amizade'+agenteSolicitado).className='btn btn-danger pull-right';
        

    }






})
}







function amizade(agenteSolicitante,agenteSolicitado){
  var caminho = "{{ route('conta.amizade') }}";


$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       agenteSolicitante: agenteSolicitante,
       agenteSolicitado:agenteSolicitado
      

    },
    success: function(data) {

     
        console.log(data)
        $('#botaoAmizade'+agenteSolicitado).html(` <button class="btn btn-danger btn-sm pull-right" id="amizade`+agenteSolicitado+`" onclick="cancelarPedido('`+data.id+`','`+agenteSolicitado+`')">Cancelar Pedido</button>`)
       // $('#amizade'+agenteSolicitado).attr('class','btn btn-danger btn-sm pull-right')
        //document.getElementById('#amizade'+agenteSolicitado).className='btn btn-danger pull-right';
        



    }






})

}


function busqueMensagens(){

  texto= $('#inputEnviarMensagem').val()
    agenteDestino=$('#agenteDestino').val()

    var caminho = "{{ route('conta.enviarMensagens') }}";
  var agente= {{ session()->get('id') }}

$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       texto: texto,
       agenteDestino:agenteDestino
    },
    success: function(data) {
        console.log(data)
        variavel = JSON.parse(data)

        const d = new Date(variavel.oagenteorigem.perfil.created_at)
        if($("#informacaoMensagem").css("display")=="block"){
          $("#informacaoMensagem").hide()
        }
      
        $('#chat-message').append(`<li class="left">
                      			<img src="{{ url('storage/`+variavel.oagenteorigem.perfil.fotoPerfil+`') }}" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>`+variavel.oagenteorigem.perfil.nome+`</h5>
                              	<small class="text-muted">`+d.getDay()+'/'+d.getMonth()+'/'+d.getFullYear()+`</small>
                              </div>
                              <p>`+variavel.texto+`</p>
                            </div>
                      		</li>`)


                          $('#inputEnviarMensagem').attr("placeholder","Escreva a sua mensagem").val("").focus().blur();
                         
                 
                           

    }


     
    

})




}


function mensagens(amigo,idAmigo,tipo=null,nome=null){
  var caminho = "{{ route('conta.amigoMensagens') }}";
  var agente= {{ session()->get('id') }}

$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       amigo: amigo,
    },
    success: function(data) {

        console.log(data)
        variavel = JSON.parse(data)
     
        if(tipo!=null){
          $('#conteudos').html(`
          <div class="chat-room">
        <h5>Falando com `+nome+`</h5>
              <div  class="row">
          <div class="col-md-12">

<!--Chat Messages in Right-->
<div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
  <div class="tab-pane active" id="contact-1">
    <div class="chat-body">
      <ul class="chat-message" id="chat-message">

          


       
      </ul>
    </div>
  </div>


  
</div><!--Chat Messages in Right End-->
<input type="hidden" id="agenteDestino" value=`+amigo+`>
<div class="send-message" style="display: none">
  <div class="input-group">
    <input type="text" class="form-control" id="inputEnviarMensagem" placeholder="Escreva a sua mensagem">
    <span class="input-group-btn">
      <button class="btn btn-default" id="enviarMensagemNova" onclick="busqueMensagens()" type="button">Enviar</button>
    </span>
  </div>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>
          `)
        }

    if(variavel.length==0 && tipo!=null){
          $('#chat-message').html('<p id="informacaoMensagem">Ainda não trocaram mensagens!</p>')
          $('#agenteDestino').val(amigo)
           $('.send-message').show()
         
      
    }else{
      $('#chat-message').html(' ')
       for(let i=0; i<variavel.length;i++){
                        var esquerda=" ";
                        var direita = " ";
                        const d = new Date(variavel[i].oagenteorigem.perfil.created_at)
                    
                      if(variavel[i].agenteOrigem==agente ){
                     
                        esquerda= `<li class="left">
                                            <img src="{{ url('storage/`+variavel[i].oagenteorigem.perfil.fotoPerfil+`') }}" alt="" class="profile-photo-sm pull-left" />
                                            <div class="chat-item" >
                                              <div class="chat-item-header">
                                                <h5>`+variavel[i].oagenteorigem.perfil.nome+`</h5>
                                                <small class="text-muted">`+d.getDay()+'/'+d.getMonth()+'/'+d.getFullYear()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds()+`</small>
                                              </div>
                                              <p>`+variavel[i].texto+`</p>
                                            </div>
                                          </li>`
                        }
                        if( variavel[i].agenteOrigem!=agente){
                          direita=`<li class="right">
                                            <img src="{{ url('storage/`+variavel[i].oagenteorigem.perfil.fotoPerfil+`') }}" alt="" class="profile-photo-sm pull-right" />
                                            <div class="chat-item">
                                              <div class="chat-item-header">
                                                <h5>`+variavel[i].oagenteorigem.perfil.nome+`</h5>
                                                <small class="text-muted">`+d.getDay()+'/'+d.getMonth()+'/'+d.getFullYear()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds()+`</small>
                                              </div>
                                              <p>`+variavel[i].texto+`</p>
                                            </div>
                                          </li>`
                        
                      }



                      

                        $('#chat-message').append(esquerda+direita)
                        $('#chat-alert'+idAmigo).hide()
                    
                    }





                    $('#agenteDestino').val(amigo)
                    $('.send-message').show()
                    
                    }
    }
               

})
}



      
      $('document').ready(function(){
















$('#enviarMensagem').on('click',function(){

    texto= $('#inputEnviarMensagem').val()
    agenteDestino=$('#agenteDestino').val()

    var caminho = "{{ route('conta.enviarMensagens') }}";
  var agente= {{ session()->get('id') }}

$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
       texto: texto,
       agenteDestino:agenteDestino
    },
    success: function(data) {
        console.log(data)
        variavel = JSON.parse(data)

        const d = new Date(variavel.oagenteorigem.perfil.created_at)
      
        $('#chat-message').append(`<li class="left">
                      			<img src="{{ url('storage/`+variavel.oagenteorigem.perfil.fotoPerfil+`') }}" alt="" class="profile-photo-sm pull-left" />
                      			<div class="chat-item">
                              <div class="chat-item-header">
                              	<h5>`+variavel.oagenteorigem.perfil.nome+`</h5>
                              	<small class="text-muted">`+d.getDay()+'/'+d.getMonth()+'/'+d.getFullYear()+`</small>
                              </div>
                              <p>`+variavel.texto+`</p>
                            </div>
                      		</li>`)


                          $('#inputEnviarMensagem').attr("placeholder","Escreva a sua mensagem").val("").focus().blur();
                         
                        //  $('.chat-room').scrollTo(500, 500);
                           

    }


     
    

})

})
  
    var conteudo= $('#pesquisa').val()
    var caminho = "{{ route('conta.logados') }}";
    var agente= {{ session()->get('id') }};
    

///aqui deve ter o id user e não deve ser a publicção do mesmo user.
// var publicacao = 2; ///aqui  deve conter o id da publicação  


//header()
$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    success: function(data) {
        variavel = JSON.parse(data)
        console.log(variavel)
     
        for(let i=0; i<variavel.length;i++){
          var botao =" "
          console.log(variavel[i].agenteSolicitante)
          console.log(variavel[i].agenteSolicitado)

          if(variavel[i].agenteSolicitante==agente &&variavel[i].agentesolicitado!=null ){
            botao =`<li><a  title="`+variavel[i].agentesolicitado.perfil.nome+`"><img src="{{ url('storage/`+variavel[i].agentesolicitado.perfil.fotoPerfil+`') }}" alt="user" class="img-responsive profile-photo" onclick="mensagens('`+variavel[i].agenteSolicitado+`','`+variavel[i].id+`','1','`+variavel[i].agentesolicitado.perfil.nome+`')" /><span class="online-dot"></span></a></li>
        `
         
          }
          if(variavel[i].agenteSolicitado==agente && variavel[i].agentesolicitante!=null ){

            botao =`<li><a  title="`+variavel[i].agentesolicitante.perfil.nome+`"><img src="{{ url('storage/`+variavel[i].agentesolicitante.perfil.fotoPerfil+`') }}" alt="user" class="img-responsive profile-photo" onclick="mensagens('`+variavel[i].agenteSolicitante+`','`+variavel[i].id+`','1','`+variavel[i].agentesolicitante.perfil.nome+`')" /><span class="online-dot"></span></a></li>
        `

          }

          $('#ponto-chat').append( botao)
        

        }
    }

})
















        $('#pesquisa').on('keyup',function(){
    $('#conteudos').hide();
    var conteudo= $('#pesquisa').val()
    var caminho = "{{ route('feed.pesquisar') }}";
    var agente= {{ session()->get('id') }};
          console.log(agente)

///aqui deve ter o id user e não deve ser a publicção do mesmo user.
// var publicacao = 2; ///aqui  deve conter o id da publicação  


//header()
$.ajax({

    method: "GET",
    enctype: 'multipart/form-data',
    url: caminho,
    data: {
        conteudo: conteudo,
        agente:agente
      

    },
    success: function(data) {

        variavel = JSON.parse(data)
        console.log(variavel)
        $('#conteudos').html('')
/*
for(let i=0; i<variavel.length;i++){
      $('#conteudos').append(`<div class="col-md-6 col-sm-6">
                            <div class="friend-card">
                                <img src="{{url('storage/`+variavel[i].fotoPerfil+`')}}" alt="profile-cover" class="img-responsive cover" />
                                <div class="card-info">
                                <img src="{{url('storage/`+variavel[i].fotoPerfil+`')}}" alt="user" class="profile-photo-lg" />
                                <div class="friend-info">
                                    <a href="#" class="pull-right text-green">Meu amigo</a>
                                    <h5><a href="timeline.html" class="profile-link">`+variavel[i].nome+`</a></h5>
                                    <h5><a href="timeline.html" class="profile-link">`+variavel[i].username+`</a></h5>
                                </div>
                                </div>
                            </div>
                        </div>`)
                      }*/


                      for(let i=0; i<variavel.perfil.length;i++){
                        //
                          var botao= ` <button class="btn btn-primary btn-sm pull-right" id="amizade`+variavel.perfil[i].userId+`" onclick="amizade('`+agente+`','`+variavel.perfil[i].userId+`')">Pedir Amizade</button>`
                          for(let j=0; j<variavel.amigos.length;j++){
                            //se fiz pedido e foi aceite, somos amigos
                            if(variavel.amigos[j].agenteSolicitante==agente && variavel.amigos[j].agenteSolicitado==variavel.perfil[i].userId && variavel.amigos[j].estado=='aceite'){
                              botao= `<p class=" btn btn-primary pull-right">Amigos</p>`
                              //se fiz pedido e est[a em espera, posso cancelar o pedido]
                            }else if(variavel.amigos[j].agenteSolicitante==agente && variavel.amigos[j].agenteSolicitado==variavel.perfil[i].userId && variavel.amigos[j].estado=='pedido'){
                              botao= ` <button class="btn btn-danger btn-sm pull-right" id="amizade`+variavel.amigos[j].agenteSolicitado+`" onclick="cancelarPedido('`+variavel.amigos[j].id+`','`+variavel.amigos[j].agenteSolicitado+`')">Cancelar Pedido</button>`
                              //se recebi  pedido, pposso aceitar ou rejeitar
                            }else if(variavel.amigos[j].agenteSolicitante==variavel.perfil[i].userId && variavel.amigos[j].agenteSolicitado==agente && variavel.amigos[j].estado=='pedido'){
                                  botao= ` <button class="btn btn-warning btn-sm pull-right" id="amizade`+variavel.perfil[i].userId+`" onclick="rejeitarPedido('`+variavel.amigos[j].id+`','`+variavel.perfil[i].userId+`')">Rejeitar Pedido</button>
                                           <button class="btn btn-success btn-sm pull-right" id="amizade`+variavel.perfil[i].userId+`" onclick="aceitarPedido('`+variavel.amigos[j].id+`','`+variavel.perfil[i].userId+`')">Aceitar Pedido</button>
                                  `
                                  //se fui aceite, entao somos amigos
                            }else if(variavel.amigos[j].agenteSolicitante==variavel.perfil[i].userId && variavel.amigos[j].agenteSolicitado==agente && variavel.amigos[j].estado=='aceite'){

                              botao= `<p class=" btn btn-primary pull-right">Amigos</p>`
                            }
                          }
                        //var botao= ` <button class="btn btn-primary btn-sm pull-right" id="amizade`+variavel.perfil[i].userId+`" onclick="amizade('`+agente+`','`+variavel[i].userId+`')">Pedir Amizade</button>`
                      //se for o user da sessão, não aparece nenhm botão
                        if(variavel.perfil[i].userId==agente){botao=""}
      $('#conteudos').append(`          <div class="nearby-user">
                <div class="row" >
                  <div class="col-md-2 col-sm-2">
                    <img src="{{url('storage/`+variavel.perfil[i].fotoPerfil+`')}}" alt="user" class="profile-photo-lg" />
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">`+variavel.perfil[i].nome+`</a></h5>
                    <p>`+variavel.perfil[i].username+`</p>
                    <p class="text-muted">500m away</p>
                  </div>
                  <div id="botaoAmizade`+variavel.perfil[i].userId+`" class="col-md-3 col-sm-3">
                  `+botao+`
                   </div>
                </div>
              </div>`)}
      $('#conteudos').show()





    }


})



})


      })









      $('#permissaoAmizade').on('change', function() {


var caminho = "{{ route('perfil.alterarPermissao') }}";
var permissao = $('#permissaoAmizade').val()
var perfil = {{ session()->get('perfil') }}
console.log(permissao)


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
        id: perfil,
        tipo:"amigos"

    },
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    success: function(data) {
        console.log(data)
        

        $('#permissaoMensagem').html(data)
        $('#permissaoMensagem').show()
        setTimeout(function(){location.reload()}, 2000);


  


    }


})






})
    </script>
            <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
            <script src="{{asset('assets/js/jquery.sticky-kit.min.js')}}"></script>
            <script src="{{asset('assets/js/jquery.scrollbar.min.js')}}"></script>
            <script src="{{asset('assets/js/script.js')}}"></script>
            <script src="{{asset('assets/js/step.js')}}"></script>
       