@extends('../header')

@section('content')

    @include('feed/lados/esquerdaPagamento')
  

<div class=" efectuarPagamento">
    <div class="col-md-12">
     {{--  @if(Auth::user()->tipo=='root')
        <input type="text" name="utilizador">
        @endif--}}
      

	
<div class="col-md-12 ">
    <div class="mensagem" id="modalMensagem" style="display: none; width:100%; background-color:#36e0d2">
        <h5> {{ $resposta }} </h5>
    </div>
    
  </div>



        <div class=" col-md-6 form-group">

            <form method="POST" action="{{ route('pagamentos.depositar') }}"  enctype="multipart/form-data" >
              {{ csrf_field() }}
                <label for="">Valor</label>
                <input type="text" class="form-control" name="valor">
          
                

     
            <div class="profilePrint" style="float: right">
                    <input type="submit" class="btn btn-primary">
            </div>
    </form>
    </div>
    </div>
</div>


    @include('feed/lados/direitaPagamento')  
    @include('../footer')
@endsection
   