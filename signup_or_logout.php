<?php

    session_start();
    
    //Boton sign up
    if(!isset($_SESSION['username'])){
        header('Location: sign_up.php');
    }
    
    //Boton log out
    else{
        unset($_SESSION['username']);
        session_destroy();
        header('Location: index.php');
    }
?>