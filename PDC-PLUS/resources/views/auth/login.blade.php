@extends('app')

@section('content')

<div>
    <div class="card-header">
                    
        @if(session()->has('erro'))
            <div class="error">
            <h5> {{session()->get('erro') }}</h5>
        </div>
        @endif
            @if(session()->has('eliminado'))
        <div class="eliminado">
            <h5> {{session()->get('eliminado') }}</h5>
        </div>
        @endif
    </div>

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
@endsection
