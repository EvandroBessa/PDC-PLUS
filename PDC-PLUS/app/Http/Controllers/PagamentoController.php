<?php

namespace App\Http\Controllers;

use App\Amigos;
use App\Perfil;
use App\Publicacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapClient;
class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
    public function pagamigo(){
        return "Pagamigo";
    }

    public function largacaixa(){
        return "Largacaixa";
    }
    public function conexaoWebService($servico){

        $cliente= new EntrarController();
     
        return $cliente->conexao($servico);
    }

    public function index()
    {
       
        $cliente = $this->conexaoWebService($this->pagamigo()); 

        return  $cliente->meusPagamentos(['agente_id'=>Auth::user()->id]);
    
    }


    public function criarConta($id){

        $cliente = $this->conexaoWebService($this->pagamigo());

         $cliente->criarConta(["agente_id"=>$id,"saldo"=>0,"estado"=>"aberta",'created_at'=>now(),'updated_at'=>now()]);

    }

 
///////////////////////////VIEW DE PAGAMENTOS/////////////////
 public function pagamentos(){
    $cliente = $this->conexaoWebService($this->pagamigo()); 
   $dados=  $cliente->consultarConta(["agente_id"=>session()->get('id')]); 

   $m= $cliente->meusPagamentos(["agente_id"=>session()->get('id')]);
  //dd($dados);
  $meuspagamentos = (Object)  $m;
  $num=0;
  if( is_array($m)){
    $num=1;
  }
         

     return view('pagamento.pagamento',compact("dados","meuspagamentos","num"));
 }



 public function donativo(){

    $amigos =  Amigos::with('agentesolicitado.perfil','agentesolicitante.perfil','agentesolicitante','agentesolicitado')
    ->where('agenteSolicitado',session()->get('id'))
    ->orWhere('agenteSolicitante',session()->get('id'))
    ->where('estado','aceite')
    ->get(); 


    return view('pagamento.fazerdonativo',compact("amigos"));
}



public function doar(Request $request){
    
 //  return $request; exit;
   $largacaixa = new PublicacaoController();
   $meuInfo= 0;
   $lg =$this->conexaoWebService($this->largacaixa());
   $cliente =$this->conexaoWebService($this->pagamigo()); 

///verificar saldo
   $saldoDoador= $cliente->verificarSaldo(["agente_id"=>session()->get('id')]);
   $saldoBeneficiario = $cliente->verificarSaldo(["agente_id"=>$request->amigo]);
   
///se tiver saldo sufuciente
   if($saldoDoador>$request->valor){
///efectue o donativo
        $cliente->efectuarDonativo(['agenteDoador_id'=>session()->get('id'),'agenteReceptor_id'=>$request->amigo,
       'valor'=>$request->valor,'estado'=>"aprovado",'created_at'=>now(),'updated_at'=>now()]);
     
      ///actualize as contas
       $comprar= $cliente->actualizarConta(["agente_id"=>session()->get('id'),"saldo"=>$saldoDoador-$request->valor,"updated_at"=>now()]);
       $vender= $cliente->actualizarConta(["agente_id"=>$request->amigo,"saldo"=>$saldoBeneficiario+$request->valor,"updated_at"=>now()]);
       
      
       
       return redirect()->back()->with('resposta',"Donativo efectuado com sucesso");
   
   }else{
       //se o saldo for baixo
       $v=$request->valor-$saldoDoador;
    return redirect()->back()->with("erro","Saldo insuficiente para realizar esta doação, precisa de mais $v Kzs");
       
   }
  

 
   
   
   
}
















    public function visualizarDonativos($id){
       
        $cliente = $this->conexaoWebService($this->pagamigo()); 
       return $cliente->visualizarDonativo(['donativo_id'=>$id]);
        
    }

    

    public function visualizarTodosDonativos(){
        
        $cliente = $this->conexaoWebService($this->pagamigo()); 
        return $cliente->visualizarTodosDonativos();
       
    }

    public function visualizarMeusDonativosEfectuados(){
       
        $cliente = $this->conexaoWebService($this->pagamigo()); 
        $donativos= $cliente->visualizarMeusDonativosEfectuados(['agente_id'=>session()->get('id')]);
$array=array();
$saldos=0;
        if(is_countable($donativos)){
                foreach($donativos as $dn){
                  $saldos+=$dn->valor;
                            $array[]=$dn->agenteReceptor_id;
                        }
                      
        }
     //   dd($array);
      

        $receptores= Perfil::with('agente')->whereIn('agente_id',$array)->get();

       //return $receptores; exit;
                return view('pagamento.donativosEfectuados',compact("receptores","donativos","saldos"));

       
    }

    
    public function visualizarMeusDonativosRecebidos(){
       
        $cliente = $this->conexaoWebService($this->pagamigo()); 
        $donativos= $cliente->visualizarMeusDonativosRecebidos(['agente_id'=>session()->get('id')]);
        $array=array();
        $saldos=0;
        if(is_countable($donativos)){
                foreach($donativos as $dn){
                    $saldos+=$dn->valor;
                            $array[]=$dn->agenteDoador_id;
                        }

        }
        
        $receptores= Perfil::with('agente')->whereIn('agente_id',$array)->get();
        return view('pagamento.donativosRecebidos',compact("receptores","donativos","saldos"));




    }



    public function efectuarDonativos(Request $request){
        $dados= new JUDDIController();
        $cliente =$this->conexaoWebService($this->pagamigo()); 
        return $cliente->efectuarDonativo(['agenteDoador_id'=>$request->agenteDoador_id,'agenteReceptor_id'=>$request->agenteReceptor_id,
        'valor'=>$request->valor,'estado'=>$request->estado,'created_at'=>now(),'updated_at'=>now()]);
    


    }



    public function todosPagamentos(){
      
        $cliente =$this->conexaoWebService($this->pagamigo()); 
        return $cliente->todosPagamentos();
      
    }





   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($conteudo,$vendedor)
    {
        return view('feed/efectuarPagamento',compact('conteudo','vendedor'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pagar(Request $request)
    {

      //  return $request; exit;
        $largacaixa = new PublicacaoController();
        $meuInfo= 0;
        $lg =$this->conexaoWebService($this->largacaixa());
        $cliente =$this->conexaoWebService($this->pagamigo()); 
        $saldoComprador= $cliente->verificarSaldo(["agente_id"=>session()->get('id')]);
        $saldoVendedor = $cliente->verificarSaldo(["agente_id"=>$request->vendedor]);
        $meuconteudo= $lg->meuConteudo(["agente_id"=>session()->get('id')]);

        if(is_countable($meuconteudo)){

            foreach($meuconteudo as $m){
            if($m->id==$request->conteudo){
                $meuInfo=1;
            }
        }
        }
        

        //se o conteudo já for meu ou 
        if($meuInfo==1){
            $mensagem=["mensagem"=>"Este Conteudo já foi adquirido por si",
                        "numero"=>400];
                        return json_encode($mensagem);
        }


        if($saldoComprador>$request->valor){


             $cliente->efectuarPagamento(['agenteComprador_id'=>$request->comprador,'agenteVendedor_id'=>$request->vendedor,'conteudo_id'=>$request->conteudo,
            'valor'=>$request->valor,'endereco'=>$request->comprovativo,'tipo'=>$request->tipo,'estado'=>"aprovado",'created_at'=>now()]);
          
           
            $comprar= $cliente->actualizarConta(["agente_id"=>$request->comprador,"saldo"=>$saldoComprador-$request->valor,"updated_at"=>now()]);
            $vender= $cliente->actualizarConta(["agente_id"=>$request->vendedor,"saldo"=>$saldoVendedor+$request->valor,"updated_at"=>now()]);
             $largacaixa->comprarMeuConteudo($request->comprador,$request->conteudo,$request->tipo);
            
            if($request->tipo=="compra"){
                $mensagem=["mensagem"=>"Compra efectuada com sucesso, aceda os seus conteudos para ver mais!",
                "numero"=>200,
                
            ];
            }else{
                $mensagem=["mensagem"=>"Aluguer efectuado com sucesso, aceda os seus conteudos para ver mais!",
                "numero"=>200];
            }
            
        
        
        }else{
            $v=$request->valor-$saldoComprador;
            $mensagem=["mensagem"=>"Saldo insuficiente, precisa de mais $v Kzs",
                        "numero"=>400];
            
        }
        //return redirect()->route('pagamentos.verificarSaldo',$saldo); exit;
     
        return json_encode($mensagem);
        
        
        
    }

    function pagamento($saldo){

        return $saldo; exit;
    }

    public function deposito(){
        $resposta= '';
        return view('pagamento.deposito',compact("resposta"));
    }


    public function depositar(Request $request){
     //   return $request; exit;
        $cliente =$this->conexaoWebService($this->pagamigo()); 
        $saldo= $cliente->verificarSaldo(["agente_id"=>session()->get('id')]);
       
         $cliente->actualizarConta(["agente_id"=>session()->get('id'),"saldo"=>$saldo+$request->valor,"updated_at"=>now()]);
         $saldo= $cliente->verificarSaldo(["agente_id"=>session()->get('id')]);

         return redirect()->back()->with("resposta","Deposito efectuado com sucesso, Saldo actual: $saldo");


    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $cliente =$this->conexaoWebService($this->pagamigo()); 
       return $cliente->consultaPagamento(['pagamento_id'=>$id]);
   
    }





    public function visualizarPagamento(Request $request){
        $cliente =$this->conexaoWebService($this->largacaixa()); 
     $pg= $this->show($request->id);

     //dd($pg);
     $agenteComprador= Perfil::where('agente_id',$pg->agenteComprador_id)->first();
     $agenteVendedor= Perfil::where('agente_id',$pg->agenteVendedor_id)->first();
     $conteudo = $cliente->acederConteudo(["conteudo_id"=>$pg->conteudo_id]);
     $publicacao= Publicacao::where('id',$conteudo->publicacao_id)->first();

     return json_encode(["pagamento"=>$pg,"agenteComprador"=>$agenteComprador,"agenteVendedor"=>$agenteVendedor,"conteudo"=>$conteudo,"publicacao"=>$publicacao]);
     
     






        
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
        //
    }
}
