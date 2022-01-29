<?php

namespace App\Http\Controllers;

use App\Amigos;
use App\Comentario;
use App\Pontuacao;
use App\Publicacao;
use App\Resposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Type\ObjectType;
use SoapClient;
use Throwable;

class PublicacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        
    }
    public function largacaixa(){
        return "Largacaixa";
    }
    public function nomeFuncaoP(){
        return "Pagamigo";
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function conexaoWebService($servico){

        $cliente= new EntrarController();
        $c= $cliente->conexao($servico);
        if($c==false){
            return false;
        }
        return $c;
    }



    function my_sanitize_string($string) {
        $string = strip_tags($string);
        $string = addslashes($string);


        return filter_var($string, FILTER_SANITIZE_STRING);
    }
    
    function my_sanitize_html($string) {
        $string = strip_tags($string, '<a><strong><em><hr><br><p><u><ul><ol><li><dl><dt><dd><table><thead><tr><th><tbody><td><tfoot>');
        $string = addslashes($string);

        
        return filter_var($string, FILTER_SANITIZE_STRING);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();


        $publicacao= new Publicacao();
        $publicacao->unicoId=uniqid();
        $publicacao->legenda = $request->dado;
        $publicacao->tipo = $request->tipo;

        if($request->conteudo){ $publicacao->conteudo=$request->titulo; }
        $publicacao->agente_id= session()->get('id');

        if($request->permissao==0){$publicacao->permissao_id= 4;}else{ $publicacao->permissao_id= $request->permissao;}
       
        $publicacao->estado='publicado';
       

        
        try{
            $publicacao->save();
        }catch(Throwable $e){
            DB::rollBack();
            return json_encode("Erro ao inserir $e");


        }
      DB::commit();
      if($request->conteudo){
       // $publicacao->conteudo= request()->file('conteudo')->store('conteudo','public');

        $resultados = $this->conexaoWebService($this->largacaixa());
        $ficheiro= new FtpController();
        $file = $ficheiro->envioFicheiro(request()->file('conteudo'));
        $resultados->carregarConteudo(['titulo'=>$request->titulo,'endereco'=>request()->file('conteudo')->store('conteudo','public')
        ,'tipo'=>$request->tipo,'estado'=>"publicado",'preco'=> ($request->preco) ? $request->preco: 0 ,"publicacao_id"=>$publicacao->id,'agente_id'=>session()->get('id'),"permissao_id"=>$request->permissao,'created_at'=>now(),'updated_at'=>now()]);
       // $resultados->return;
    }

    if($request->ajax()){
        return json_encode($publicacao); exit;
    }
        return redirect()->back()->with("resposta","Conteudo Partilhado com Sucesso");
    

      

         
       
    }


    public function comentar(Request $request){
        $p = Publicacao::where('unicoId',$request->publicacao)->first();
        DB::beginTransaction();
        $comentario = new Comentario();
        $comentario->texto= $request->dado;
        $comentario->publicacao_id= $p->id;
        $comentario->unicoId= uniqid();
        $comentario->tipo= "comentario";
        if($request->comentarioResposta)
                $comentario->tipo= "resposta";
            
        $comentario->agente_id= $request->agente;//Auth::user()->id;
        
        try{
            $comentario->save();
        }catch(Throwable $e){
            DB::rollBack();
            return json_encode("Erro ao inserir");


        }
        DB::commit();


        if($request->comentarioResposta){

            $c = Comentario::where('unicoId',$request->comentarioResposta)->first();
            $resposta= new Resposta();

            $resposta->comentarios_id= $c->id;
            $resposta->resposta_id= $comentario->id;
            $resposta->estado= "activo";
            $resposta->save();
        }

       

        $c= Comentario::with('user')->where('id',$comentario->id)->first();

        return json_encode($c);
        
    }



    public function procurarComentario($id){
        $comentario= Comentario::find($id);
 
        return json_encode($comentario);
    }
    public function editarComentario(Request $request){

        $comentario= Comentario::where('unicoId',$request->comentario)->first();
        
        $comentario->texto= $request->dado;
        $comentario->update();

        return json_encode($comentario);

      }


      public function eliminarPublicacao($publicacao_id)
      {
         $publicacao = Publicacao::find($publicacao_id);
         $publicacao->estado= 'Eliminado';
         $publicacao->update();
      }

      public function permissoes(){
          return view('feed.permissoes');
      }

      public function permissaoPublicacao(Request $request){
          $publicacao = Publicacao::find($request->id);
          $publicacao->permissao_id= $request->permissao_id;
          $publicacao->update();

          return redirect()->back()->withInput(['Permissao Alterada']);

      }

      public function pontuacao(Request $request){
       //se a publicação for positiva e já existir negativo
       //se for negativa e já existir positivo
       $pub= Publicacao::where('unicoId',$request->publicacao)->first();
       $p= Pontuacao::where('agente_id','=',$request->agente_id)->where('publicacao_id','=',$pub->id)->first();
       if(!$p){

                $pontuacao = new Pontuacao();
                            $pontuacao->valor= $request->valor;
                            $pontuacao->agente_id= $request->agente_id;//Auth::user()->id;
                            $pontuacao->publicacao_id=$pub->id;
                            $pontuacao->save();
       }else{

                $p->valor= $request->valor;
                $p->save();
       }
         

            $valores= [
            'positivo' => Pontuacao::where('publicacao_id',$pub->id)->where('valor','=',1)->count(),
            'negativo' =>Pontuacao::where('publicacao_id',$pub->id)->where('valor','=',0)->count()
            ];

            return json_encode($valores);



      }

      public function publicacoes(){
        
        $largacaixa= $this->conexaoWebService($this->largacaixa());
        $largacaixa->meuConteudo(['agente_id' => 2]);




        $pontuacao= DB::table('pontuacaos');
        $publicacao= Publicacao::with('agente','permissao')->withCount(['pontuacao as positivo'=>function($query){
            $query->where('valor','=','1');
        },'pontuacao as negativo'=>function($query){
            $query->where('valor','=','0');
        },'comentario as numeroComentarios'])->with(['comentario.respostas.respostacomentario'])->orderBy('created_at','ASC')
        ->paginate(5);

      
        
 // return $publicacao; exit;

      /*  leftjoin('comentarios','comentarios.publicacao_id','publicacaos.id')
        ->leftjoin('users','users.id','comentarios.agente_id')
        ->select('publicacaos.*','publicacaos.id as pubId','users.username',
        'comentarios.id as comId','comentarios.texto as comTexto','comentarios.agente_id as comAgente','comentarios.publicacao_id as comPub','comentarios.created_at as comCreat')*/
        
       

    
      //  $pontuacao= Pontuacao::with('agente','publicacao')->union($publicacao)->get();

        
/*
          $publicacao = DB::table('publicacaos')->join('users','pubicacaos.agente_id','users.id')
          ->join('permissaos','publicacaos.permissao_id','permissaos.id')
          ->where('publicacaos.estado','<>','eliminado')
        
          ->whereExists( function ($query){
            $query->select()->from('amigos')
            ->where('amigos.agenteSolicitado','=',2)
          ;
         })
         ->orWhereExists( function ($query){
            $query->select()->from('amigos')
            ->where('amigos.agenteSolicitante','=',2)
          ;
         })
         
         ->select('publicacaos.*','publicacaos.id as pubId','publicacaos.created_at as pubCreated','users.*','permissaos.id as permId','permissaos.tipo as permTipo','permissaos.*')
         ->orderBy('publicacaos.created_at','desc')->paginate(12);*/
          
   // return $userComentarios; exit;

         return view('feed/feed',compact('publicacao','userComentarios'));
      }


      public function comentariosPublicacao(Request $request){
        

        $p= Publicacao::where('unicoId',$request->publicacao)->first();
        $c= Comentario::with('user')->withCount(['respostas'=>function($query){
            $query->where('estado','activo');
        }])->where('tipo','comentario')->where('publicacao_id',$p->id)->get();
$comentario= ["comentarios"=>$c,"numero"=>$c->count()];
        return json_encode($comentario);
      }

///////RESPOSTAS DOS COMENTARIOS
      public function respostas(Request $request){

        
    $comentario= Comentario::where('unicoId',$request->comentario)->first();
     

        $r= Resposta::with('respostacomentario','respostacomentario.user')->where('comentarios_id',$comentario->id)->get();

        $respostas= ["respostas"=>$r,"numero"=>$r->count()];
        return json_encode($respostas);

      }





/*
      public function scroll($ultimo){

        $publicacao = DB::table('publicacaos')->
        where('publicacaos.agente_id','>',$ultimo)
        ->join('users','publicacaos.agente_id','users.id')
     
        ->whereExists( function ($query){
          $query->select()->from('amigos')
          ->where('amigos.agenteSolicitado','=',2)
        ;
       })
       ->orWhereExists( function ($query){
          $query->select()->from('amigos')
          ->where('amigos.agenteSolicitante','=',2)
        ;
       })   
       ->select('publicacaos.*','publicacaos.id as pubId','users.*')->orderBy('publicacaos.created_at','asc')->get();
        

        return json_encode($publicacao);
    }
*/





    public function scrollPublicacoes(Request $request){
        $lg= $this->conexaoWebService($this->largacaixa());
        if($lg!=false ){

             $largacaixa=$lg->visualizar();

            $meuconteudo= $lg->meuConteudo(["agente_id"=>session()->get('id')]);
            if(!is_countable($meuconteudo)){

                   $meuconteudo = " ";
            }
        }else{
         
            $largacaixa = " ";
        }

             ///meus amigos 
                $amigos =  Amigos::where('agenteSolicitado',session()->get('id'))
                ->orWhere('agenteSolicitante',session()->get('id'))
                ->where('estado','aceite')
                ->get(); 
 $permissao=[2,3,4];
$array=array();
            
                    foreach($amigos as $amigos){
                    if($amigos->agenteSolicitado==session()->get('id')){
                        $array[]= $amigos->agenteSolicitante;
                    }else{
                        $array[]= $amigos->agenteSolicitado;
                    }
                }

                                
                        if(!empty($array)){

                            $publicacao= Publicacao::with('agente','permissao')->withCount(['pontuacao as positivo'=>function($query){
                                            $query->where('valor','=','1');
                                        },'pontuacao as negativo'=>function($query){
                                            $query->where('valor','=','0');
                                        },'comentario as numeroComentarios'])->with(['comentario.respostas.respostacomentario'])->where('agente_id',session()->get('id'))
                                        ->orWhereIn('agente_id',$array)->whereIn('permissao_id',$permissao)->
                                        orderBy('created_at','DESC')
                                        ->paginate(5);

                        }else{
                            $permissao=[4];
                                        $publicacao= Publicacao::with('agente','permissao')->withCount(['pontuacao as positivo'=>function($query){
                                            $query->where('valor','=','1');
                                        },'pontuacao as negativo'=>function($query){
                                            $query->where('valor','=','0');
                                        },'comentario as numeroComentarios'])->with(['comentario.respostas.respostacomentario'])
                                        ->whereIn('permissao_id',$permissao)->
                                        orderBy('created_at','DESC')
                                        ->paginate(5);

                        }

                                    
               

           //     return $array;
      //  $e= json_decode($d);
                //publicações permitidas
              

                if($request->ajax()){

                        $view = view('feed.publicacoes',compact('publicacao','e','largacaixa','meuconteudo'))->render();
                        return response()->json(['html'=>$view]);

                    }

                    return view('feed/feed',compact('publicacao',"e","largacaixa"));


    }

    public function principal(){

         return view('feed/feed',compact('publicacao',"e"));

    }



    public function visualizarConteudo(){
       

        $dados= $this->conexaoWebService($this->largacaixa());
     
   
        return $dados->visualizar();
    }


    public function conteudoGratis(){
     
        $dados= $this->conexaoWebService($this->largacaixa());
     
   
        return $dados->carregarGratis();


    }

    public function conteudoPago(){
        $dados= $this->conexaoWebService($this->largacaixa());
     
   
        return $dados->carregarPago();



    }


    public function acederConteudo($conteudo_id){

          
        $dados= $this->conexaoWebService($this->largacaixa());
     
   
        return $dados->acederConteudo(['conteudo_id'=>$conteudo_id]);


    }

    public function comprarMeuConteudo($agente,$conteudo,$estado){
            $dados= $this->conexaoWebService($this->largacaixa());
           return $dados-> comprarConteudo(["agente_id"=>$agente,"conteudo_id"=>$conteudo,"estado"=>$estado,"created_at"=>now(),"updated_at"=>now()]);
    }


    public function patrocinarConteudo(Request $request){
        $dados= $this->conexaoWebService($this->largacaixa());
     
   
        return $dados->patrocinarConteudo(['conteudo_id'=>$request->conteudo_id,'data_inicio'=>$request->dataInicio, 
        'data_fim'=>$request->dataFim, 'created_at'=>now(),'updated_at'=>now() ]);

       
    }

    public function actualizarConteudo(Request $request){

        $dados= $this->conexaoWebService($this->largacaixa());
     
   
        return $dados->actualizarConteudo(['conteudo_id'=>$request->conteudo_id,'titulo'=>$request->titulo,'updated_at'=>now()]);

        
     

    }


    public function comprarAlugarConteudo(Request $request){
        $dados= $this->conexaoWebService($this->largacaixa());
     
   
        return $dados->comprarConteudo(['agente_id'=>$request->agente_id,'conteudo_id'=>$request->conteudo_id,'estado'=>$request->estado,'created_at'=>now(),'updated_at'=>now() ]);
        
     

    }






public function verificarConteudo(){
    $lg= $this->conexaoWebService($this->largacaixa());
    $conteudo= $lg->meuConteudo(["agente_id"=>session()->get('id')]);

    return json_encode($conteudo);
}







    public function alterarPermissao(Request $request){

        DB::beginTransaction();


        $publicacao = Publicacao::find($request->id);
        $publicacao->permissao_id= $request->permissao;
      

        try{
            $publicacao->update();
        }catch(Throwable $e){
            DB::rollBack();
            return "erro ao alterar $e";
        }

        DB::commit();


        return 'sucesso';
    }

    

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicacao = Publicacao::find($id);
        $publicacao->estado='eliminado';
        $publicacao->updated_at=now()->format('Y-m-d H:i:s');
        $publicacao->update();

        return redirect()->back();
    }
}
