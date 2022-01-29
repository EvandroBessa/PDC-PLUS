@extends('../header')

@section('content')

    @include('feed/lados/esquerdaPagamento')
  









    <div class=" efectuarPagamento">
        <div class="col-md-12">
         {{--  @if(Auth::user()->tipo=='root')
            <input type="text" name="utilizador">
            @endif--}}
          
    
            @if(session()->has('resposta'))
            <div class="alert alert-success  show mensagem" role="alert" style=" width:100%;">
                <h5> {{session()->get('resposta') }}</h5>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            
            @endif
    
    
    
            <div class=" col-md-12 form-group">
    
                <form method="POST" action="{{ route('pagamento.doar') }}"  enctype="multipart/form-data" >
                  {{ csrf_field() }}
                    
                    <div class="form-group col-md-6">
                        <label for="">Amigo Beneficiário</label>
                         <select name="amigo" class="form-control select2" id="amigoDonativo">
                             @foreach ($amigos as $amigo)
                                    @if($amigo->agenteSolicitante==session()->get('id'))
                                        <option value="{{ $amigo->agenteSolicitado }}"> {{ $amigo->agentesolicitado->perfil->nome }} </option>
                                    @else
                                        <option value="{{ $amigo->agenteSolicitante }}"> {{ $amigo->agentesolicitante->perfil->nome }} </option>
                                    @endif
                             @endforeach
                           
                      
                    </select>
                    </div>
                   <div class="form-group col-md-6">
                    <label for="">Valor</label>
                              <input type="text" class="form-control" name="valor">
                   </div>
             
              
                    
    
         
                <div class="profilePrint" style="float: right">
                        <input type="submit" class="btn btn-primary">
                </div>
        </form>
        </div>
        </div>
    </div>





<script>

$("#amigoDonativo").select2({
 placeholder:'Escolha o Amigo',
 allowClear:true
});
  
</script>





    @include('feed/lados/direitaPagamento')  
    @include('../footer')
@endsection
   