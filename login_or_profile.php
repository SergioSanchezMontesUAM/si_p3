<?php

    session_start();

    //Boton log in
    if(!isset($_SESSION['username'])){
        header('Location: log_in.php');
    }
    
    //Boton profile
    else{
        header('Location: history.php');
    }
?>