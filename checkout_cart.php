<?php

  try{
    $database = new PDO("pgsql:dbname=si1; host=localhost", "alumnodb", "alumnodb");
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  $database->exec("update orders set shipmentstatusid=1 where orderid=" . $_POST['orderid']);

?>
