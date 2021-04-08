<?php
    namespace app;

    class Db {

        private $user;
        private $password;
        private $server;
        private $connect;
        private $error;
        private $db;

        public function __construct($server,$user,$password,$db=''){
            $this->server = $server;
            $this->user = $user;
            $this->password = $password;
            $this->db = $db;
            $this->connect = NULL;
            $this->error = 0 ;
            //$this->is_connected = FALSE;
        }

        public function connect(){
            if(empty($this->db))
                $this->connect = new \mysqli($this->server,$this->user,$this->password);
            else
                $this->connect = new \mysqli($this->server,$this->user,$this->password,$this->db);
        }

        public function createDB($db)
        {
           return $this->connect->query("CREATE DATABASE IF NOT EXISTS ".$db);
        }

        public function isConnected(){

            return $this->connect->connect_errno ?FALSE:TRUE;
        }

        public function getConnectErrno(){

            return $this->connect->connect_errno;
        }

        public function selectDB($db){
           return  $this->connect->select_db($b);
        }

        public function getSelectedDB(){

            $row = [];
           if($result = $this->connect->query("SELECT DATABASE()")) {
                $row = $result->fetch_row();
                $result->close();
            }
            return empty($row)?FALSE:$row[0];
        }

        public function createTable($table){

            $req = "CREATE TABLE IF NOT EXISTS `".$table."` (
                id INT(11) AUTO_INCREMENT ,
                name VARCHAR(30) NOT NULL,
                position int NOT NULL,
                color VARCHAR(30) NOT NULL,
                PRIMARY KEY (id)
                )";
            return $this->connect->query($req);
        }

        public function insertItems($table,$nb_items){
            
           $array = [];

           $color =[
            'bg-primary',
            'bg-secondary',
            'bg-success',
            'bg-danger',
            'bg-info',
            'bg-dark',
            ];

            for($i=0 ; $i< $nb_items; $i++){

                $key = array_rand($color);
                $req = "INSERT INTO ".$table." (name, position, color ) VALUES ('item_".random_int(100, 999)."', '".($i+1)."', '".$color[$key]."')";
                if(!$this->connect->query($req))
                {
                    break;
                    return FALSE;
                }
                
            }

            return TRUE;
        
        }


        public function updateItemsPosition($table,$id,$position ){

            $req = "UPDATE ".$table." SET position='".$position."' WHERE id=".$id;
            return $this->connect->query($req);
        }

        public function getConnectError(){
            return $this->connect->connect_error;
        }
        public function getError(){
            return $this->connect->error;
        }

        public function selectItems($table) {

            $req = "SELECT * FROM ".$table." ORDER BY position ASC" ;

            if ($result = $this->connect->query($req)) {
                if($result->num_rows!== 0){
                    return $result->fetch_all(MYSQLI_ASSOC) ;
                }
                return FALSE;
            }

            return FALSE;
        }

        public function close(){
            $this->connect->close();
        }
        
    }



?>