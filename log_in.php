<?php
	
	if(isset($_POST['submit_log_in'])){
		
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		
		//Construimos la ruta de la carpeta correspondiente al usuario
	    $path = getcwd() . "/usuarios/" . $username;
	    
	    //Comprobamos si está registrado
	    if(!file_exists($path)){
	        echo "Usuario no registrado";
	    }
	    else{
	        $dat_file = fopen($path . "/datos.dat", "r");
	        $i = 0;
	        while(($line = fgets($dat_file)) !== false){

	        	//Línea de datos.dat correspondiente a la contraseña
	        	if($i == 1){
	        		
	        		if(strncmp($line, $password, strlen($password)-1) == 0){
			        			
		    			session_start();
		    			$_SESSION['username'] = $username; 
		    			
		    			//Si viene del carrito porque queria pagar sin estar logeado, le mandamos al carrito de nuevo
		    			if(isset($_COOKIE['from_cart'])){
		    				//Eliminamos la cookie
		    				setcookie('from_cart', "", time()-3600);
		    				unset($_COOKIE['from_cart']);
		    				
							header('Location: cart.php');
		    			}
						else header('Location: index.php');

	        		}
	        		else{
	        			//contraseña inconrrecta
	        		}
	        		
	        	}
	        	
	        	$i++;
	        }
	    }
	}
	
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Acceder</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="sign_up_container">

	<a href="index.php" class="header_only_title">
		<div id="header_second_column_logo"></div>
		<div id="header_second_column_name">MOVIE ARCHIVE</div>
	</a>

	<div class="log_in_card_div">

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				
			<table id="sign_up_table">
				<tr>
					<td id="sign_up_table_th">Iniciar sesión</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">Nombre</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">
						<input class="sign_up_input" type="text" name="username">
					</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">Contraseña</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">
						<input class="sign_up_input" type="password" name="password">
					</td>
				</tr>
				<tr>
					<td id="log_in_table_forgot_done">
						<div id="sign_up_forgot_pass">Has olvidado tu contraseña?</div>
						<input type="submit" name="submit_log_in" id="sign_up_done_btn" value="Hecho">
					</td>
				</tr>
			</table>

		</form>

	</div>

	<div class="sign_up_footer">
		<div class="sentence">
			<p>Aún no tienes una cuena? &nbsp;¡</p>
			<a id="sign_up_login_btn" href="sign_up.html">
				<p>Regístrate</p>
			</a>
			<p> &nbsp;ahora!</p>
		</div>
	</div>
</body>
</html>