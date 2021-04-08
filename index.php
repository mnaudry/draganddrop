<?php
    $title ="List Drag and Drop";
    include "templates/header.php";
?>
  <div class="container">
  <?php

      require_once("classes".DIRECTORY_SEPARATOR."Db.php");
      require_once("classes".DIRECTORY_SEPARATOR."util.php");

      $error_code = 0 ;
      $error_message = "";
      $db = NULL ;
      $nb_default_items = 5 ;
      $config =[];
      $row_items = [];

      require_once("config/config.php");

      if($error_code) {
        $print_message = \App\Util::printError($error_message, $error_code);
        include "templates/error.php";
        
      }else {
        $nb_items = $config['items'] ?? $nb_items;
        $error = \App\Util::getItems($db,$config['table'],$nb_items);

        if($error['error_code'] === 0){
          $row_items = $error['items'];
          
          include "templates/draganddrop.php";
        }else {
          $print_message = \App\Util::printError($error['error_message'], $error['error_code']);
          include "templates/error.php";
        }
        
      }
  ?>
  </div>
<?php
    include "templates/footer.php";
?>
