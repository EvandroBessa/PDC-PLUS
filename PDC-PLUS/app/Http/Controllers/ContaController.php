<?php

namespace App\Http\Controllers;

use App\Amigos;
use App\Localizacao;
use App\Mensagem;
use App\Pais;
use App\Perfil;
use App\Provincia;
use App\User;
use SoapClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $verificador=0;

    public function conexaoWebService(){

        $cliente= new SoapClient("http://192.168.100.2:8080/WebApplication3/pagamigo?xsd");
     
        return $cliente;
    }

    public function index()
    {
        $cliente = $this->conexaoWebService();
        $resultados= $cliente->visualizarContas();
        return $resultados->return;
    }

    public function criarConta(Request $request){

        $cliente = $this->conexaoWebService();
        $resultados= $cliente->criarConta(['agente_id'=>$request->agente_id,'saldo'=>$request->saldo,'estado'=>$request->estado,'created_at'=>now(),'updated_at'=>now()]);
        return $resultados->return;
    }


    public function visualizarDados($id){
         

     
            $user= User::with('localizacao','localizacao.provincia','localizacao.opais')->where('id',$id)->first();
            $perfil = Perfil::with('permissao')->where('agente_id', $id)->first();
            $pais= Pais::all();
            $provincia=Provincia::all();
            $activar = $this->verificarAmizade($id,'perfil');


     //  return $user; exit;
            return view('feed.perfil',compact("user","perfil","pais","provincia","activar"));
    }

    public function alterarPerfil(Request $request){

        $perfil= Perfil::where('id',session()->get('perfil'))->first();

        

        if($perfil->nome!=$request->nome)
            $perfil->nome=$request->nome; 
        if($perfil->genero!=$request->genero)
            $perfil->genero=$request->genero;
        if($perfil->data_nascimento!=date('Y-m-d',strtotime($request->dataNascimento)))
            $perfil->data_nascimento=date('Y-m-d',strtotime($request->dataNascimento));
        if($perfil->nif!=$request->nif)
            $perfil->nif=$request->nif;
        
       $perfil->update();

            return redirect()->back()->with("resposta","Dados do Perfil alterados com sucesso");
            //return redirect()->back()->with("resposta","Nenhum dado Para ser alterado");
    }

    public function alterarConta(Request $request){
        $user= User::where('id',session()->get('id'))->first();

       

        $localizacao= Localizacao::where('id',$request->localizacao)->first();
        
        if($localizacao->bairro!=$request->bairro )
            $localizacao->bairro=$request->bairro;
        if($localizacao->cidade!=$request->cidade and $request->cidade!=0)
            $localizacao->cidade=$request->cidade;
        if($localizacao->pais!=$request->pais and $request->pais!=0)
            $localizacao->pais=$request->pais;
        
        $localizacao->update();
        



        if($user->username!=$request->username)
            $user->username=$request->username;
        if($user->email!=$request->email)
            $user->email=$request->email;
        if($user->telefone!=$request->telefone)
            $user->telefone=$request->telefone;
        
        $user->update();


        return redirect()->back()->with("resposta","Dados da Conta alterados com sucesso");
        
        
    }

    

    public function alterarPermissao(Request $request){

        DB::beginTransaction();


        $perfil = Perfil::find($request->id);
        if($request->tipo){
            $perfil->permissaoAmizade= $request->permissao;
        }
        $perfil->permissao_id= $request->permissao;
      

        try{
            $perfil->update();
        }catch(Throwable $e){
            DB::rollBack();
            return "erro ao alterar $e";
        }

        DB::commit();


        return 'Permissão alterada com sucesso';
    }


    public function eliminarConta(){
        $user= User::where('id',session()->get('id'))->first();

        $user->estado='eliminado';
        $user->update();

        session()->pull('id');
        return redirect('entrar')->with('eliminado','Conta eliminada com sucesso!');

        

    }


public function pesquisar(Request $request){

    $perfil = Perfil::join('users','perfils.agente_id','=','users.id')
    ->where('perfils.nome','like',"%$request->conteudo%")
    ->orWhere('users.username','like',"%$request->conteudo%")
    
    ->select('perfils.*','users.id as userId','users.*')->get();

    $amigos= Amigos::all();
$dados= ["amigos"=>$amigos,
        "perfil"=>$perfil
        ];




    return json_encode($dados);


}

public function amizade(Request $request){


    $amigos= new Amigos();

    $amigos->agenteSolicitante= $request->agenteSolicitante;
    $amigos->agenteSolicitado= $request->agenteSolicitado;
    $amigos->estado="pedido";

    $amigos->save();

    return $amigos;

}

public function cancelarPedido(Request $request){
    $pedido = Amigos::where('id',$request->pedido)->first();
    

    return $pedido->delete();
}

public function aceitarPedido(Request $request){
    $pedido = Amigos::where('id',$request->pedido)->first();
    $pedido->estado='aceite';
  

    return   $pedido->update();
}

public function pedidosRecebidos(){
    $amigos= Amigos::with('agentesolicitante','agentesolicitante.perfil')
    ->where('agentesolicitado',session()->get('id'))
    ->where('estado','pedido')
    ->get();
    $numero= $amigos->count();
   // return $amigos;
    return view('feed.pedidosRecebidos',compact('amigos','numero'));
}

public function pedidosEnviados(){
    $amigos= Amigos::with('agentesolicitado','agentesolicitado.perfil')
    ->where('agenteSolicitante',session()->get('id'))
    ->where('estado','pedido')
    ->get();
    $numero= $amigos->count();
    return view('feed.pedidosEnviados',compact('amigos','numero'));
}


///verificar se um utilizador é nosso amigo ou não
public function verificarAmizade($id,$tipo){
    $amigos =  Amigos::with('agentesolicitado.perfil','agentesolicitante.perfil','agentesolicitante','agentesolicitado')
    ->where('agenteSolicitado',$id)
    ->orWhere('agenteSolicitante',$id)
    ->where('estado','aceite')
    ->get(); 

    $perfil= Perfil::with('permissaoamizade')->where('agente_id',$id)->first();

   // return $amigos; exit;
 
   $meuamigo="";
   $amigosdomeuamigo="";
   $activar =0;
   
   if($id!=session()->get('id')){

     ///o user é meu amigo??
   $meuamigo= Amigos::where('agenteSolicitado',$id)
   ->orWhere('agenteSolicitante',session()->get('id'))
   ->where('estado','aceite')
   ->first();
   if(!$meuamigo){
    $meuamigo= Amigos::where('agenteSolicitante',$id)
    ->orWhere('agenteSolicitado',session()->get('id'))
    ->where('estado','aceite')
    ->first();
   }



///apartir da lista dos meus amigos, verifico se os amigos dos meus amigos são kambas do do user actual

   foreach($amigos as $amigos){
       if($amigos->agentesSolicitante==$id){
          // $array[]=$amigos->agenteSolicitado;
           $amigosdomeuamigo= Amigos::where('agenteSolicitado',$amigos->agenteSolicitado)
           ->orWhere('agenteSolicitante',session()->get('id'))
           ->where('estado','aceite')
           ->get();
           if(!$amigosdomeuamigo){
                $amigosdomeuamigo= Amigos::where('agenteSolicitante',$amigos->agenteSolicitado)
           ->orWhere('agenteSolicitado',session()->get('id'))
           ->where('estado','aceite')
           ->get();
           }
          

       }elseif( $amigos->agentesSolicitado==$id && !$amigosdomeuamigo){
       // $array[]=$amigos->agenteSolicitante;
                $amigosdomeuamigo= Amigos::where('agenteSolicitado',$amigos->agenteSolicitante)
                ->orWhere('agenteSolicitante',session()->get('id'))
                ->where('estado','aceite')
                ->get();
        if(!$amigosdomeuamigo){
                $amigosdomeuamigo= Amigos::where('agenteSolicitante',$amigos->agenteSolicitante)
                ->orWhere('agenteSolicitado',session()->get('id'))
                ->where('estado','aceite')
                ->get();
        }
      
       }
   }

}

        if($tipo=='amizade'){
            ///verifica a permissão de amizade
             if($perfil->permissaoAmizade == 4){
                    $activar= 1;
                }elseif($perfil->permissaoAmizade==1 and $id!=session()->get('id')){
                    $activar=0;
                }elseif($perfil->permissaoAmizade==2 and $meuamigo!=""){
                    $activar=1;
                }elseif($perfil->permissaoAmizade==3 and $amigosdomeuamigo!=""){
                    $activar=1;    
                }elseif($id==session()->get('id')){
                    $activar=1;
                }

        }else{

            ///verifica a permissão do perfil
            if($perfil->permissao_id == 4){
                $activar= 1;
            }elseif($perfil->permissao_id==1 and $id!=session()->get('id')){
                $activar=0;
            }elseif($perfil->permissao_id==2 and $meuamigo!=""){
                $activar=1;
            }elseif($perfil->permissao_id==3 and $amigosdomeuamigo!=""){
                $activar=1;    
            }elseif($id==session()->get('id')){
                $activar=1;
            }
        }
               
        return $activar;
}


public function amigos($id){
    $amigos =  Amigos::with('agentesolicitado.perfil','agentesolicitante.perfil','agentesolicitante','agentesolicitado')
    ->where('agenteSolicitado',$id)
    ->orWhere('agenteSolicitante',$id)
    ->where('estado','aceite')
    ->get(); 

    $perfil= Perfil::with('permissaoamizade')->where('agente_id',$id)->first();
    $numero= $amigos->count();
   $activar = $this->verificarAmizade($id,'amizade');
  
    return view('feed.amigos',compact('amigos','numero','perfil','activar'));


  
    if(request()->ajax()){
        return json_encode($amigos);
    }



}



public function mensagens(){

    /*
    $mensagens = Mensagem::with(['oagenteorigem','oagenteorigem.perfil'])
    ->with(['oagenteorigem'=> function($query){
        $query->withCount(['mensagem'=>function($query){
            $query->where('estado','fechada');
        }]);
    }])->where('agenteDestino',session()->get('id'))
    ->orderBy('created_at','ASC')->get();
*/

$amigos = Amigos::with(['agentesolicitado.perfil','agentesolicitante.perfil'])
->withCount(['enviomensagemsolicitante'=>function($query){
    $query->where('estado','fechada');
},'enviomensagemsolicitado'=>function($query){
    $query->where('estado','fechada');
}])->where('agenteSolicitado',session()->get('id'))
->orWhere('agenteSolicitante',session()->get('id'))
->where('estado','aceite')->get(); 

   
    return view('feed.mensagens',compact("amigos"));
}


public function amigoMensagens(Request $request){
    $m= DB::table('mensagems')->where('agenteOrigem',session()->get('id'))
->where('agenteDestino',$request->amigo)->select('id');

    $mensagens = Mensagem::with(['oagenteorigem','oagenteorigem.perfil','oagentedestino','oagentedestino.perfil'])
    ->where('agenteDestino',session()->get('id'))
    ->where('agenteOrigem',$request->amigo)
    ->orWhereIn('id',$m)
    ->orderBy('created_at','ASC')->get();


if($mensagens){
    foreach($mensagens as $mensagem){
        $msg= Mensagem::where('id',$mensagem->id)->where('estado','fechada')->first();
        if($msg ){
            //só abro as mensagens de quem manda, não as que eu mando
            if($msg->agenteOrigem!=session()->get('id')){
                $msg->estado= "aberta";
                $msg->update();
            }
          
        }
         
    }
}
    


        return json_encode($mensagens);


}


public function enviarMensagens(Request $request){
    $mensagem = new Mensagem();
    $mensagem->texto= $request->texto;
    $mensagem->agenteOrigem= session()->get('id');
    $mensagem->agenteDestino = $request->agenteDestino;
    $mensagem->estado = "fechada";

    $mensagem->save();

    $mensagens = Mensagem::with(['oagenteorigem','oagenteorigem.perfil','oagentedestino','oagentedestino.perfil'])
    ->where("id",$mensagem->id)->first();
    return json_encode($mensagens);
}


public function logados(){

    $user =  Amigos::with(['agentesolicitado.perfil','agentesolicitante.perfil',
    'agentesolicitante'=>function($query){
        $query->where('estado','logado');

    },'agentesolicitado'=>function($query){
        $query->where('estado','logado');
    }])
    ->where('agenteSolicitado',session()->get('id'))
    ->orWhere('agenteSolicitante',session()->get('id'))
    ->where('estado','aceite')
    ->get(); 

    return json_encode($user);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
         
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->conexaoWebService();
        $resultados= $cliente->consultarConta(['agente_id'=>$id]);
        return $resultados->return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $cliente = $this->conexaoWebService();
        $resultados= $cliente->actualizarConta(['agente_id'=>$request->agente_id,'saldo'=>$request->saldo,'updated_at'=>now()]);
        return $resultados->return;
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
        //
    }
}
