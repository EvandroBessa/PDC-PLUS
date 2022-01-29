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

                @if(count($receptores)>0)
                <h3>Lista de Donativos</h3>
                <h5>Toal já oferecido: {{ number_format($saldos,2) }}</h5>
                <table class="table table-striped">
                    <thead>
                      <tr>
                       
                        <th scope="col">Beneficiário</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Data</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                     
                        @foreach ($donativos as $dn)
                       
                                <tr>
                                    @foreach ($receptores as $r)
                                
                                            @if($dn->agenteReceptor_id==$r->agente_id)
                                                    <th scope="row">{{ $r->nome }}</th>  
                                            @endif
                                     @endforeach
                       
                                <td>{{$dn->valor }}</td>
                                <td>{{ $dn->estado }}</td>
                                <td>{{ date('d-m-Y',strtotime($dn->created_at)) }}</td>
                               
                       
                
                        @endforeach
                     
                     
                      
                    </tbody>
                  </table>
                  @else
                    <h3>Ainda não efectuou nenhum donativo!</h3>
                  @endif

            </div>


    @include('feed/lados/direitaPagamento')  
    @include('../footer')
@endsection
   