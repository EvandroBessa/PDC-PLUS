<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Crypt; 
use Illuminate\Contracts\Encryption\DecryptException;

class FtpController extends Controller
{
   
        private $ftp_server = "127.0.0.1";
        private $ftp_username = "Diogo Manuel";
        private $ftp_userpass = "amor0808";
    
        public function envioFicheiro($file){
            $nome = $file->getClientOriginalName();
            $extensao = $file->getClientOriginalExtension();
            $ficheiro = Crypt::encryptString($nome).".".$extensao;
            $ftp_conn = ftp_connect($this->ftp_server) or die("Could not connect to $this->ftp_server");
            $login = ftp_login($ftp_conn, $this->ftp_username, $this->ftp_userpass);
            
            // open file for reading
            
            $fp = fopen($file,"r"); 
            // upload file
            if (ftp_fput($ftp_conn, $ficheiro, $fp, FTP_BINARY))
            {
                echo "Successfully uploaded $file.";
                return $ficheiro;
            }
            else
            {
            echo "Error uploading $file.";
            }
    
            // close this connection and file handler
            ftp_close($ftp_conn);
            fclose($fp);
        }
    
        public function getFilesFtp($server_file){
            $local_file = public_path("tmp/".$server_file);
            
            // set up basic connection
            $ftp = ftp_connect($this->ftp_server);
    
            // login with username and password
            $login_result = ftp_login($ftp, $this->ftp_username, $this->ftp_userpass);
                
            // try to download $server_file and save to $local_file
            try{
                $get = ftp_get($ftp, $local_file, $server_file, FTP_BINARY);
                if(isset( $get)) {
                    
                } else {
                    
                    echo "Off\n";
                }
            }catch(Exception $e){
                return;
            }
            // close the connection
            ftp_close($ftp);
    
        }
    
}
