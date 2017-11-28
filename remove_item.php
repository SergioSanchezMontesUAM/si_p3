<?php

  try{
    $database = new PDO("pgsql:dbname=si1; host=localhost", "alumnodb", "alumnodb");
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }

  $orderid = $_POST['orderid'];
  $prodid = $_POST['prodid'];

  $database->exec("delete from orderdetail where orderid=" . $orderid . " and prodid=" . $prodid);

?>
