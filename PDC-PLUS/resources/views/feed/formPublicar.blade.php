
	<head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
   
<div class="row" id="rowLegenda">
    <div class="col-md-7 col-sm-7">
      <select name="permissao" id="permissao">
        <option value="1">Privado</option>
        <option value="2">Amigo</option>
        <option value="3">Amigo do Amigo</option>
        <option value="4">Publica</option>
      </select>
  <div class="form-group">
    
    <textarea name="legenda" id="legenda" cols="60" rows="1" class="form-control" placeholder="Escreva o que sentes"></textarea>
    <input type="hidden" name="tipo" id="tipo" value="1">
   


</div>
</div>

    <div class="col-md-5 col-sm-5">
  <div class="tools">

    <button class="btn btn-primary pull-right" id="publicar">Publicar</button>
  </div>
</div>
</div>
<script src="../assets/js/jquery-3.1.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.sticky-kit.min.js"></script>
<script src="../assets/js/jquery.scrollbar.min.js"></script>
<script src="../assets/js/script.js"></script>

<script>

    $('document').ready(function(){
    
      $('#publicar').on('click',function(){
    
        
          if($('#legenda').val()!=''){
              
                  var caminho= "{{ route('publicacao.publicar') }}";
                  var dado= $('#legenda').val();
                  var tipo= $('#tipo').val();
                  var permissao = $('#permissao').val();
                
            $.ajaxSetup({
                   headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                  
                  },
              });
    
    
    
    
    
    
                    $.ajax({
                        
                  method:"POST",
                  enctype: 'multipart/form-data',
                  url: caminho, 
                  data:{
                  dado:dado,
                  tipo:tipo,
                  permissao:permissao,
                  },
                
                  success:function(data){
                      console.log(data)
                      variavel= JSON.parse(data)
                    //  $("tbody").hide()
    
    
    
                
                
                  }
                
    
        })
    
    
    
    
          }
    
      })
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    })
    
    </script>





