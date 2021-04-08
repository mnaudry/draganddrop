<?php
     require_once("..".DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."Db.php");
     require_once("..".DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."util.php");

     error_reporting(0);
     mysqli_report(MYSQLI_REPORT_OFF);
  
     $config =  parse_ini_file("..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."app.ini");

     $db = new \App\Db($config['server'],$config['user'],$config['pwd'],$config['db']);
     
     $db->connect();

     $db->updateItemsPosition($config['table'],$_POST['id'],$_POST['position']);


?>