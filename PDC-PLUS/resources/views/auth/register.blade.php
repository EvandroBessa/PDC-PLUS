@extends('app')

@section('content')

<div>

<!-- <div class="card-body"> -->
    <div class="container">
        <div class="sign-up-form">
            <!-- <a href="index.html" class="logo"><img src="../../../public/assets/images/logo.png" alt="PDCPLUS"/></a> -->
            <h2 class="text-white">PDC-PLUS</h2>
            <div class="line-divider"></div>
                <div class="form-wrapper">
                    <form method="POST" action="{{ route('entrei') }}">
                        @csrf
                        <fieldset class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                        <fieldset class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </fieldset>
                    
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Lebrar de Mim') }}
                            </label>
                        </div>
                        <button class="btn-secondary">Entrar</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </form>
                </div>
                <a href="{{ route('registo') }}">Criar uma conta</a>
                <!-- <img class="form-shadow" src="images/bottom-shadow.png" alt="" /> -->
            </div><!-- Sign Up Form End -->
            
        </div>
</div>
</div>
                <!-- </div> -->
            <!-- </div>
        </div> -->
        <section id="features">
			<div class="container wrapper">
				<h1 class="section-title slideDown">social herd</h1>
				
				<div id="incremental-counter" data-value="101242"></div>
			
				<img src="images/face-map.png" alt="" class="img-responsive face-map slideUp hidden-sm hidden-xs" />
			</div>

		</section>
        



        <section id="live-feed">
			<div class="container wrapper">
				
				
			
				
			</div>
		</section>





    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">   
                    <h2>Criar Conta</h2>
                    <div class="row ">
                        <button  class="btn btn-primary  col-sm-4 gx-5" id="individual">Individual</button>  
                        <button  id="organizacao" class="btn btn-success col-sm-4 gx-5" >Organização</button>
                        <!-- <button class="btn btn-danger col-sm-4" >cancelar</button> -->
                        <div id="tindividual" style="display: none"> <h5>Conta de agente individual</5></div>
                        <div id="torganizacao" style="display: none"> <p>Conta de agente organizacional</p></div>
                    </div>
                </div>

                <div class="card-body" id="registar" style=" @if($errors->any()) display:block @else display:none @endif">
                    <form method="POST" class="register" id="formRegister" action="{{ route('registar') }}"   name="registo" enctype="multipart/form-data" >
                        @csrf
                 <div class="tab" >
                    <div class="form-wrap max-width-600 mx-auto">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nome" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">{{ __('username') }}</label>

                            <div class="col-md-9">
                               
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirme a Senha') }}</label>

                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab" style="display: none" >
                        <div class="form-group row">
                            <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                            <div class="col-md-6">
                                <input id="telefone" type="text" class="form-control @error('telefone') is-invalid @enderror" name="telefone" value="{{ old('telefone') }}" required autocomplete="telefone" autofocus>

                                @error('telefone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="genero" class="col-md-4 col-form-label text-md-right">{{ __('Genero') }}</label>

                            <div class="col-md-6">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Femenino') }}</label>
                                <input id="femenino" type="radio" class="form-control @error('name') is-invalid @enderror" name="genero" value="F"  >
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Masculino') }}</label>

                                <input id="masculino" type="radio" class="form-control @error('name') is-invalid @enderror" name="genero"  value="M" >

                                @error('genero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="dataNascimento" class="col-md-4 col-form-label text-md-right">{{ __('data de Nascimento') }}</label>

                            <div class="col-md-6">
                                <input id="dataNascimento" type="date" class="form-control @error('dataNascimento') is-invalid @enderror" name="dataNascimento" value="{{ old('dataNascimento') }}" required autocomplete="dataNascimento" autofocus>

                                @error('dataNascimento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row" id="nif">
                            <label for="nif" class="col-md-4 col-form-label text-md-right">{{ __('NIF') }}</label>

                            <div class="col-md-6">
                                <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif') }}" required autocomplete="nif" autofocus>

                                @error('nif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="col-md-6">
                            <label for="fotoPerfil" class="col-md-4 col-form-label text-md-right">{{ __('Foto de Perfil') }}</label>
                            <input id="fotoPerfil" type="file" class="form-control-file form-control height-auto @error('fotoPerfil') is-invalid @enderror" accept="image/*" name="fotoPerfil" >
                         
                            @error('fotoPerfil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                  

                        
                        <div class="form-group row">
                            <select name="permissao" class="form-control" style="width: 25%; font-size:10px; height:30px "
                            id="permissao_id">
                            <option selected value="0">Quem pode ver?</option>
                            <option value="1">Privado</option>
                            <option value="2">Amigo</option>
                            <option value="3">Amigo do Amigo</option>
                            <option value="4">Publica</option>
                        </select>
                        </div>


                               
                        <div class="form-group row">
                            <label for=""> Endereço</label>
                            <input id="bairro" type="text" placeholder="Bairro" class="form-control @error('bairro') is-invalid @enderror" accept="image/*" name="bairro" value="{{ old('bairro') }}" required autocomplete="bairro" autofocus>

                            <select name="provincia" class="form-control" style="width: 25%; font-size:10px; height:30px "
                            id="pais">
                            <option selected >Provincia</option>
                            @foreach ($provincia as $provincia )
                            <option value= {{ $provincia->id  }}>{{ $provincia->nome }}</option>
                            @endforeach
                            </select>
                            <select name="pais" class="form-control" style="width: 25%; font-size:10px; height:30px "
                            id="pais">
                            <option selected >Pais</option>
                            @foreach ($pais as $pais )
                            <option value= {{ $pais->id  }}>{{ $pais->nome }}</option>
                            @endforeach
                            </select>



                           
                           
                        
                        </div>

                        <input type="hidden" id="tipo" name="tipo">


                </div>
         


                       






                        <div style="overflow:auto">
                            <div  style="float: right; margin-right:10%">
                            <button type="button" class="btn btn-primary"  id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                            <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Proximo</button>
                            </div>
                        </div>
                            
                            
                        <div style="text-align: center; margin-top: 40px;">
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                            <span class="step"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Footer
    ================================================= -->
    <footer id="footer">
      <div class="container">
      	<div class="row">
          <div class="footer-wrapper">
            <div class="col-md-3 col-sm-3">
              <a href=""><img src="images/logo-black.png" alt="" class="footer-logo" /></a>
              <ul class="list-inline social-icons">
              	<li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-pinterest"></i></a></li>
              	<li><a href="#"><i class="icon ion-social-linkedin"></i></a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h6>Para indivíduos</h6>
              <ul class="footer-links">
                <li><a href="">Inscrever-se</a></li>
                <li><a href="">Conecte-se</a></li>
                <li><a href="">Explorar</a></li>
                <li><a href="">Aplicativo localizador</a></li>
                <li><a href="">Recursos</a></li>
                <li><a href="">Configurações de linguagem</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h6>Sobre o Negócio</h6>
              <ul class="footer-links">
                <li><a href="">Inscrição comercial</a></li>
                <li><a href="">Login comercial</a></li>
                <li><a href="">Benefícios</a></li>
                <li><a href="">Recursos</a></li>
                <li><a href="">Advertência</a></li>
                <li><a href="">Instalação</a></li>
              </ul>
            </div>
            <div class="col-md-2 col-sm-2">
              <h6>Sobre</h6>
              <ul class="footer-links">
                <li><a href="">Sobre nós us</a></li>
                <li><a href="">Contacte-nos</a></li>
                <li><a href="">Segurança e privacidade</a></li>
                <li><a href="">Termos</a></li>
                <li><a href="">Ajuda</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-3">
              <h6>Contactos</h6>
                <ul class="contact">
                	<li><i class="icon ion-ios-telephone-outline"></i>(+244) 923 540 850</li>
                	<li><i class="icon ion-ios-email-outline"></i>evandro@hotmail.com.com</li>
                  <li><i class="icon ion-ios-location-outline"></i>228 luanda, Angola</li>
                </ul>
            </div>
          </div>
      	</div>
      </div>
      <div class="copyright">
        <p>copyright @UAN 2022. Todos direitos reservados</p>
      </div>
		</footer>

<script src="{{asset('assets/js/step.js')}}"></script>

<script>
   $('document').ready(function(){
       $('#individual').on('click', function(){
    
        $('#tindividual').show()
        $('#torganizacao').hide()
           $('#registar').show()
        $('#nif').hide()
        $('#tipo').val(1)


       })

       $('#organizacao').on('click', function(){

        
           $('#tindividual').hide()
        $('#torganizacao').show()
           $('#registar').show()
        $('#nif').show()
        $('#tipo').val(2)
        
       })

    })
</script>


@endsection
