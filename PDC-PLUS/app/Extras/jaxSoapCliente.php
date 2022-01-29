<?php

/**
 * Description of jaxSoapCliente
 *
 * @author 
 */

namespace App\Extras;

use SoapClient;

class jaxSoapCliente extends SoapClient{
    //put your code here
    public function __Call($function_name, $arguments) {
        $recebe =parent::__Call($function_name, $arguments);

        if($recebe->return){
            return $recebe->return;
        }else{
            return false;
        }
      
    }
}
