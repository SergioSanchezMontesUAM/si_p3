<?php

    //Boton log in
    if(!isset($_SESSION)){
        header('Location: log_in.php');
    }
    
    //Boton profile
    else{
        header('Location: #');
    }
?>