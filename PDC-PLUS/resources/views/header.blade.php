@extends('app')
@section('sidebar')

    <!-- Header
    ================================================= -->
    <header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown"><a href="/">Página inicial</a></li>
              {{--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Feed de notícias <span><img src="assets/images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu newsfeed-home">
                    <li><a href="/feed">Feed de notícias</a></li>
                    <li><a href="/conhecidos">Pessoas que talvez conheças</a></li>
                    <li><a href="/feed-amigos">Amigos</a></li>
                    <li><a href="/mensagens">Mensagens</a></li>
                  </ul>
              </li>--}}
             {{-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pagamentos <span><img src="assets/images/down-arrow.png" alt="" /></span></a>
                  <ul class="dropdown-menu newsfeed-home">
    
                    <li><a href="{{ route('pagamentos.efectuar',[1,3]) }}">Efectuar Pagamentos</a></li>
                    <li><a href="{{ route('pagamentos.deposito') }}">Efectuar Deposito</a></li>
                    <li><a href="/feed-amigos">Consultar Pagamento</a></li>
                    <li><a href="/mensagens">Consultar Contas de Pagamento</a></li>

                  </ul>
              </li>--}}
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil <span><img src="{{asset('assets/images/down-arrow.png')}}" alt="" /></span></a>
                <ul class="dropdown-menu login">
                  <li><a href="/perfil">Perfil</a></li>
                 
                 
                  <li><a href="{{route('sair')}}">Sair</a></li>
                </ul>
              </li>
              <li><a href="{{ route('pagamentos') }}">Pagamentos</a></li>
              <li class="dropdown"><a href="contact.html">Contactos</a></li>
              <li class="dropdown"><a href="{{ route('sair') }}">Sair</a></li>
              <li><a href="{{  route('perfil.visualizar',session()->get('id')) }}">Perfil</a></li>
            </ul>
            <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" id="pesquisa" class="form-control" placeholder="Search friends, photos, videos">
              </div>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>


    
   
    

