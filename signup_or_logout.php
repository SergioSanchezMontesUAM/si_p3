<?php

    //Boton sign up
    if(session_status() == PHP_SESSION_NONE){
        header('Location: sign_up.php');
    }
    
    //Boton log out
    else{
        unset($_SESSION['username']);
        session_destroy();
        header('Location: index.php');
    }
?>