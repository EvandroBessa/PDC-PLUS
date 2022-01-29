@extends('../header')

@section('content')
    @include('feed/lados/esquerda')
    @if(session()->has('resposta'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<h5> {{session()->get('resposta') }}</h5>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>

@endif

<div class=" efectuarPagamento">
    <div class="col-md-6">
     {{--  @if(Auth::user()->tipo=='root')
        <input type="text" name="utilizador">
        @endif--}}
        <div class="form-group">

            <form action="{{ route('pagamentos.pagar') }}" method="GET" enctype="multipart/form-data" >
                @csrf
                <label for="">Valor</label>
        <input type="text" class="form-control" name="valor" >
        <input type="hidden"  class="form-control" name="conteudo"  value="{{ $conteudo }}">
        <input type="hidden"  class="form-control" name="vendedor" value= "{{ $vendedor }}">
        <label for="">Comprador</label>
        <input type="text"  class="form-control" name="comprador">
        <label for="">Comprovativo</label>
        <input type="file" class="form-control" name="comprovativo" accept="image/*,.pdf">
        <label for="">Tipo</label>

        <select name="tipo" class="form-control" id="tipo"> 
            <option value="aluguer">Aluguer</option> 
            <option value="compra">Compra</option>
        </select>

        <input type="submit" class="btn btn-primary">
    </form>
    </div>
    </div>
</div>


    @include('feed/lados/direita')  
    @include('../footer')
@endsection
   