<!DOCTYPE html>
<html>
    <body>
        <?php
            $public_html_path = getcwd();
    	    $usuarios_path = $public_html_path . "/usuarios/";

    	    //Comprobamos si existe la carpeta usuarios. Si no existe, la creamos
    	    if (!file_exists($usuarios_path)) {
		        mkdir($usuarios_path, 0777, true);
	        }

	        $nuevo_usuario_path = $usuarios_path . $_REQUEST['username'];

	        //Si ya existe un directorio con ese nombre, el nombre de usuario ya esta en uso
	        if(file_exists($nuevo_usuario_path)){
	            echo "El nombre de usuario ya está en uso";
	        }
	        else{

    			mkdir($nuevo_usuario_path, 0777, true);

    			//Creamos el archivo .dat y guardamos la información del usuario
    			$dat_file = fopen($nuevo_usuario_path . "/datos.dat", "w");
    			fwrite($dat_file, "usuario=".$_REQUEST['username']."\n"."contraseña=".$_REQUEST['password']."\n"."email=".$_REQUEST['email']."\n"."tarjeta=".$_REQUEST['credit_card_1'].$_REQUEST['credit_card_2'].$_REQUEST['credit_card_3'].$_REQUEST['credit_card_4']."\n"."saldo=".rand(0,100));

    			$history_file = fopen($nuevo_usuario_path . "/historial.xml", "w");
	        }
        ?>
    </body>
</html>
