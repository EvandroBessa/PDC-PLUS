<?php

/**
 * Description of jaxSoapCliente
 *
 * @author Aristone Diateza; Aderito ; Leide
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Extras\JUDDI;
use App\Extras\jaxSoapCliente;

 
class EntrarController extends Controller
{
    public function conexao($servico){

        $juddi = new JUDDI();
        $juddi->conectar("root", "root");

     /*  if($c==false){
            return false; 
        }*/
    
        $wsdl = $juddi->getBinding($servico);
        $wsdlRemote = str_replace("localhost", "localhost", $wsdl);
    
        $cliente = new jaxSoapCliente($wsdlRemote);

     
             /*   if($param!=""){
                return    $dado= call_user_func(array('largacaixa',$funcao),$param);
                    $vrec = $cliente->visualizar();
                }else{
                  //return  $dado= call_user_func($funcao);
                     $vrec = $cliente->visualizar();
                }*/
                  
        
        if($cliente!=false){
            return $cliente;  
        }else{
            return false;
        }
        
        }
}
