<?php

	if(isset($_POST['submit_sign_up'])){
		
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
    			fwrite($dat_file, $_REQUEST['username']."\n".$_REQUEST['password']."\n".$_REQUEST['email']."\n".$_REQUEST['credit_card_1'].$_REQUEST['credit_card_2'].$_REQUEST['credit_card_3'].$_REQUEST['credit_card_4']."\n".rand(0,100));

    			$history_file = fopen($nuevo_usuario_path . "/historial.xml", "w");
    			
    			session_start();
    			$_SESSION['username'] = $_REQUEST['username']; 
    			
    			header('Location: index.php');
	        }
		
	}

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registrarse</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="sign_up_container">

	<a href="index.html" class="header_only_title">
		<div id="header_second_column_logo"></div>
		<div id="header_second_column_name">MOVIE ARCHIVE</div>
	</a>

	<div class="sign_up_card_div">

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				
			<table id="sign_up_table">
				<tr>
					<td id="sign_up_table_th">Registrarse</td>
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
					<td class="sign_up_table_td">Email</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">
						<input class="sign_up_input" type="text" name="email">
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
					<td id="sign_up_table_divider"></td>
				</tr>

				<tr>
					<td class="sign_up_table_td">Sexo</td>
				</tr>

				<tr>
					<td class="sign_up_table_td">
						<input type="radio" name="gender" value="male" checked> Masculino<br>
						<input type="radio" name="gender" value="female"> Femenino<br>
					</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">Tarjeta de crédito</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">
						<input class="sign_up_credit_card_input" type="text" name="credit_card_1">
						<input class="sign_up_credit_card_input" type="text" name="credit_card_2">
						<input class="sign_up_credit_card_input" type="text" name="credit_card_3">
						<input class="sign_up_credit_card_input" type="text" name="credit_card_4">
					</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">Sobre mí</td>
				</tr>
				<tr>
					<td class="sign_up_table_td">
						<textarea id="sign_up_about_me" name="about_me"></textarea>
					</td>
				</tr>

				<tr>
					<td id="sign_up_table_forgot_done">
						<input type="submit" name="submit_sign_up" id="sign_up_done_btn" value="Hecho">
					</td>
				</tr>
			</table>

		</form>

	</div>

	<div class="sign_up_footer">
		<div class="sentence">
			<p>Ya tienes una cuenta? &nbsp;</p>
			<a id="sign_up_login_btn" href="landing_history.html">
				<p>Inicia sesión</p>
			</a>
			<p> &nbsp;ahora</p>
		</div>
	</div>
</body>
</html>
