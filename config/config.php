<?php

   error_reporting(0);
   mysqli_report(MYSQLI_REPORT_OFF);

   $config =  parse_ini_file("config".DIRECTORY_SEPARATOR."database.ini");
   

   if($config === FALSE) {
        $error_message = "Impossible d'acceder au fichier de configuration.";
        $error_code = 55 ;
       
   }

   if( $error_code ===  0){

        if(isset($config['user']) && isset($config['server'])&& isset($config['pwd'])&& isset($config['db']) && isset($config['table'])){
            
            
            $error = \App\Util::createDb($config);
            
            if($error['error_code'] === 0 ){

                $db = new \App\Db($config['server'],$config['user'],$config['pwd'],$config['db']);
                $db->connect();
                
                if($db->isConnected()){
                    $error = \App\Util::createTable($db,$config['table']);

    
                    $error_code= $error['error_code'];
                    $error_message = $error['error_message'];

                }else {
                    $error_code= $db->getConnectErrno();
                    $error_message = $db->getConnectError();
                }
                
            }else{

                $error_code= $error['error_code'];
                $error_message = $error['error_message'];
            }
            
        } else {
    
            $message = "Erreur dans le fichier de configuration";
            $code = 55 ;
        }
   
    }







?>