@extends('../header')

@section('content')
@include('feed/lados/esquerdaPagamento')

<div class="col-md-12">
    <h2>Saldo Actual AOA: <div style="color:black;display:inline-block; "> {{number_format( $dados->saldo,2) }}</div></h2>
    <p>Estado da Conta: {{ $dados->estado }}</p>
    <p>Aberta desde: {{ date('d-m-Y',strtotime($dados->created_at)) }}</p>


</div>

<br>
<br>
<br><br>
<div id="visualizarPagamento"> 
   
</div>

@if($num==1)
<h3>Lista de Pagamentos</h3>
<table class="table table-striped">
    <thead>
      <tr>
       
        <th scope="col">Valor</th>
        <th scope="col">Estado</th>
        <th scope="col">Tipo</th>
        <th scope="col">Data</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
     
        @foreach ($meuspagamentos as $m)
       
                <tr>
                <th scope="row">{{ $m->valor }}</th>
                <td>{{ $m->estado }}</td>
                <td>{{ $m->tipo }}</td>
                <td>{{ date('d-m-Y',strtotime($m->created_at)) }}</td>
                <td><a class="btn btn-primary" onclick="visualizarPagamento('{{ $m->id }}')">Visualizar</a></td>
            </tr>   
       

        @endforeach
     
     
      
    </tbody>
  </table>
  @else
    <h3>Ainda não efectuou nenhum pagamento!</h3>
  @endif
  <script>
      $('document').ready(function(){
             $('#fecharVisualizarPagamento').on('click',function(){
               
  $('#visualizarPagamento').html('');

})
      })
   
  </script>
@include('feed/lados/direitaPagamento')
@include('../footer')
@endsection