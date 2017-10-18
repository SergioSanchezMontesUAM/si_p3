<!DOCTYPE html>
<html>
    <body>
        <?php

            //Construimos la ruta de la carpeta correspondiente al usuario
    	    $path = getcwd() . "/usuarios/" . $_REQUEST['username'];
    	    
    	    //Comprobamos si está registrado
    	    if(!file_exists($path)){
    	        echo "Usuario no registrado";
    	    }
    	    else{
    	        $dat_file = fopen($path . "datos.dat", "r");
    	    }
        ?>
    </body>
</html>
