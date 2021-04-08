<?php
    namespace app;
    use App\Db;

    class Util {

        public static function printError($message,$code = NULL){

            $error_message = "<strong>Erreur !</strong> $message";
            if($code){
                $error_message.="</br>";
                $error_message.="<strong>Erreur Code : </strong> $code";
            }
           
            return $error_message;
        }


        public static function createDB($config){
            $error = [
                'error_code' => 0,
                'error_message' => "",
                
            ];
            $db = new Db($config['server'],$config['user'],$config['pwd']);

            $db->connect();
            if($db->isConnected()){
                if(!$db->createDB($config['db']))
                {
                    $error['error_code'] = 56;
                    $error['error_message'] = "Un problème est survenu au cours de la création de la base de données ".$config['db'];
                }

            }else {
                $error['error_code']= $db->getConnectErrno();
                $error['error_message'] = $db->getConnectError();
            }

            $db->close();

            return $error;


        }

        public static function createTable($db, $table){

            $error = [
                'error_code' => 0,
                'error_message' => "",
                
            ];

            if(!$db->createTable($table))
            {
                $error['error_code'] = 57;
                $error['error_message'] = "Un problème est survenu au cours de la création de la table  ".$table;
            }

            return $error;
        }

        public function getItems($db,$table,$nb_items){

            $error = [
                'error_code' => 0,
                'error_message' => "",
                'items'=>[],
            ];

            if($result = $db->selectItems($table))
            {
                $error['items']=$result;
                return  $error;
            }
            else 
            {

                if(!$db->insertItems($table,$nb_items)){

                    $error['error_code'] = 58;
                    $error['error_message'] = "Une erreur est survenu lors de l'insertion d'items dans la table ".$table;
                }
                $result = $db->selectItems($table);

                if($result){
                    $error['items']=$result;
                    return  $error;
                }

                $error['error_code'] = 58;
                $error['error_message'] = "Nous n'avons pas pu reccuperer les items dans la table ".$table;

                return $error;

            }
        }

    }

?>