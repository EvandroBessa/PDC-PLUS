@extends('../header')

    @section('content')
        @include('feed/lados/esquerda')

        <div id="conteudos">
            
        @if(session()->has('resposta'))
        <div class="resposta">
        <h5> {{session()->get('resposta') }}</h5>
    </div>
            

    @endif
    <h5>Dados do Perfil</h5>
        <div>
            
            <div><p>Nome: {{ $perfil->nome }}</p></div>
            <div><p>Data de Nascimento: {{date('d-m-Y',strtotime($perfil->data_nascimento))  }}</p></div>
            <div><p>Genero: {{ $perfil->genero=="M" ? "Masculino":"Femenino" }}</p></div>
            @if($user->tipo==2)
            <div><p>Nif: {{ $perfil->nif  }}</p></div>
            @endif

            <div><p>Permissão: {{ $perfil->permissao->tipo }}</p></div>


            <a id="botaoAlterarP" class="btn btn-primary">Alterar</a>
            <a id="FbotaoAlterarP" class="btn btn-danger" style="float: right; display:none">Fechar</a>
        </div>


        <form action="{{ route('perfil.alterar') }}" method="POST" id="alterarP" style="display: none">
            {{ csrf_field() }}

            <center><h4>Alterar dados do Perfil</h4></center>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nome" value="{{ $perfil->nome }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="dataNascimento" class="col-md-4 col-form-label text-md-right">{{ __('Data de Nascimento') }}</label>

                <div class="col-md-6">
                    <input id="dataNascimento" type="text" class="form-control @error('dataNascimento') is-invalid @enderror" name="dataNascimento" value="{{date('d-m-Y',strtotime($perfil->data_nascimento))  }}" required autocomplete="dataNascimento" autofocus>

                    @error('dataNascimento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="genero" class="col-md-4 col-form-label text-md-right">{{ __('Genero') }}</label>

                <div class="col-md-6">
                    <input id="genero" type="text" class="form-control @error('genero') is-invalid @enderror" name="genero" value="{{ $perfil->genero }}" required autocomplete="genero" autofocus>

                    @error('genero')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @if($user->tipo==2)
            <div class="form-group row">
                <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('Nif') }}</label>

                <div class="col-md-6">
                    <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ $perfil->nif }}" required autocomplete="nif" autofocus>

                    @error('nif')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            @endif
            
            <div style="float: right">

            
                <button type="submit" class="btn btn-primary"> Alterar</button>
                
            </div>
        </form>


        <h5>Dados da Conta</h5>

        <div>
            <div><p>userName: {{ $user->username }}</p></div>
            <div><p>email: {{ $user->email }}</p></div>
            <div><p>Telefone: {{ $user->telefone }}</p></div>
            <div><p>Tipo: {{ $user->tipo==1 ? "Individual" : "Organizacional" }}</p></div>
            <div><p>Bairro: {{ $user->localizacao->bairro }}</p></div>
            <div><p>Provincia: {{ $user->localizacao->provincia->nome }}</p></div>
            <div><p>Pais: {{ $user->localizacao->opais->nome }}</p></div>
            <a id="botaoAlterarC" class="btn btn-primary">Alterar</a>

            <a id="FbotaoAlterarC" class="btn btn-danger" style="float: right; display:none">Fechar</a>

        </div>



        <form action="{{ route('perfil.alterarConta') }}" method="POST" id="alterarC" style="display: none">
            {{ csrf_field() }}
            
            <center><h4>Alterar dados da Conta</h4></center>
            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                <div class="col-md-6">
                    <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ $user->telefone }}" required autocomplete="telefone" autofocus>

                    @error('telefone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
          
            <div class="form-group row">
                <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>

                <div class="col-md-6">
                    <input id="bairro" type="text" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ $user->localizacao->bairro }}" required autocomplete="bairro" autofocus>

                    @error('bairro')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
              
                <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Provincia') }}</label>
                <div class="col-md-6">
                <select name="cidade" class="form-control" id="pais">
                <option selected  value=0>Provincia</option>
                @foreach ($provincia as $provincia )
                <option value= {{ $provincia->id  }}>{{ $provincia->nome }}</option>
                @endforeach
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Pais') }}</label>
                
                <div class="col-md-6">
                <select name="pais" class="form-control" id="pais">
                <option selected value=0 >Pais</option>
                @foreach ($pais as $pais )
                <option value= {{ $pais->id  }}>{{ $pais->nome }}</option>
                @endforeach
                </select>
                </div>


               
               
            
            </div>
            <input type="hidden" name="localizacao" value="{{ $user->localizacao->id }}" id="">
            <div style="float: right">

            
            <button type="submit" class="btn btn-primary"> Alterar</button>
            
        </div>
        </form>

        <h5>Permissão, escolha uma para mudar de : {{ $perfil->permissao->tipo }}</h5>

        <div id="permissaoMensagem" class="resposta" style="display: none"></div>

        <div class="form-group row">
        <select id="perm" name="permissao" class="form-control"
        style="width: 25%; font-size:10px; height:30px; margin-bottom:15px; display:inline-block;margin-right:-1" id="permissao_id">
        <option selected value=0>Selecione uma permissão</option>

        @if($perfil->permissao_id!=1) <option value=1>Privado</option>@endif
        @if($perfil->permissao_id!=2) <option value=2>Amigo</option>@endif
        @if($perfil->permissao_id!=3) <option value=3>Amigo do Amigo</option>@endif
        @if($perfil->permissao_id!=4) <option value=4>Publica</option>@endif
            </select>
        </div>
        <input type="hidden" value="{{ session()->get('perfil') }}" id="perfil">



<div id="eliminar">
    <button  class="btn btn-danger " id="eliminarBtn">Eliminar Conta</button>

<br>
<div id="eliminarMensagem" style="display: none" >
<center><h5>Tem a certeza que deseja Eliminar a Conta?</h5></center>
    <center><p>Ao Eliminar a conta, ela fica indisponivel, até que solicite uma recuperação!</p></center></div>
    <center><a href="{{ route('conta.eliminar') }}" class="btn btn-success btn-sm" style="display: none" id="sim" >Sim</a>
    <a  id="nao" class="btn btn-danger btn-sm" style="display:none ">Não</a></center>
</div>
        </div>


        
        @include('feed/lados/direita')  
        @include('../footer')


        <script>

            $('document').ready(function(){
                $('#botaoAlterarC').on('click',function(){
                    $('#alterarC').show();
                    $('#botaoAlterarC').hide();
                    $('#FbotaoAlterarC').show();

                    
                })
                $('#botaoAlterarP').on('click',function(){
                    $('#alterarP').show();
                    $('#botaoAlterarP').hide();
                    $('#FbotaoAlterarP').show();

                    
                })

                $('#FbotaoAlterarP').on('click',function(){
                    $('#alterarP').hide();
                    $('#botaoAlterarP').show();
                    $('#FbotaoAlterarP').hide();

                    
                })
                $('#FbotaoAlterarC').on('click',function(){
                    $('#alterarC').hide();
                    $('#botaoAlterarC').show();
                    $('#FbotaoAlterarC').hide();

                    
                })


                $('#perm').on('change', function() {


var caminho = "{{ route('perfil.alterarPermissao') }}";
var permissao = $('#perm').val()
var perfil = $('#perfil').val()
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
        id: perfil

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



$('#eliminarBtn').on('click',function(){
    $('#eliminarMensagem').show()
    $('#sim').show();
    $('#nao').show();
    $('#eliminarBtn').hide()

})

$('#nao').on('click',function(){
    $('#eliminarMensagem').hide()
    $('#sim').hide();
    $('#nao').hide();
    $('#eliminarBtn').show()
})
            })
        </script>
    @endsection
