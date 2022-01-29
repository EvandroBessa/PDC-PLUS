<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Extras\JUDDI;
use App\Extras\jaxSoapCliente;

class JUDDIController extends Controller
{
    public function conexao($servico,$funcao,$param=""){

        $juddi = new JUDDI();
        $juddi->conectar("root", "root");
    
        $wsdl = $juddi->getBinding($servico);
        $wsdlRemote = str_replace("localhost", "localhost", $wsdl);
    
        $cliente = new jaxSoapCliente($wsdlRemote);
                if($param!=""){
                    $dado= call_user_func($funcao,$param);
                    $vrec = $cliente->$dado;
                }else{
                    $dado= call_user_func($funcao);
                     $vrec = $cliente->$dado;
                }
                  
        
        
        return $vrec;      
        }
}
