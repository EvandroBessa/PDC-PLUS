
<div class="row">

    <!-- Newsfeed Common Side Bar Left
    ================================================= -->
    <div class="col-md-3 static">
      <div class="profile-card">
          <img src={{url('storage/'.session()->get('imagem'))}} alt="user" class="profile-photo" />
    
    
          <h5><a href="timeline.html" class="text-white">{{ session()->get('nome') }}</a></h5>
          <h6><a href="timeline.html" class="text-white">{{ session()->get('username') }}</a></h6>
          <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> 1,299 followers</a> {{-- Adicionar o numero de Amigos --}}
      </div><!--profile card ends-->
      <ul class="nav-news-feed">
        <li><i class="icon ion-ios-paper"></i><div><a href="/">Feed de notícias</a></div></li>
        <li><i class="icon ion-ios-people"></i><div><a href="/conhecidos">Pessoas que talvez conheças</a></div></li>
        <li><i class="icon ion-ios-people-outline"></i><div><a href="{{ route('conta.amigos') }}">Amigos</a></div></li>
        <li><i class="icon ion-ios-people-outline"></i><div><a href="{{ route('conta.pedidosRecebidos') }}">Pedidos de Amizade Recebidos</a></div></li>
        <li><i class="icon ion-ios-people-outline"></i><div><a href="{{ route('conta.pedidosEnviados') }}">Pedidos de Amizade Enviados</a></div></li>
        <li><i class="icon ion-chatboxes"></i><div><a href="{{ route('conta.mensagens') }}">Mensagens</a></div></li>
      </ul><!--news-feed links ends-->
      <div id="chat-block">
        <div class="title">Chat online</div>
        <ul class="online-users list-inline" id="chat-amigos">
          <p id="ponto-chat"></p>
      
        </ul>
      </div><!--chat block ends-->
    </div>
    <div class="col-md-7">
    
    
    