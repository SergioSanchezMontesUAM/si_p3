<?php

	if(isset($_POST['submit_sign_up'])){

    $username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

		try{
			$database = new PDO("pgsql:dbname=si1; host=localhost", "alumnodb", "alumnodb");
			$q_isregistered = $database->query("select * from customers where username='" . $username . "'");
			if(!$q_isregistered){
				//Nombre de usuario en uso
			}
      else{
        $database->exec("insert into customers (username, passwd) values ('" . $username . "', '" . $password . "')");

  			session_start();
  			$_SESSION['username'] = $_REQUEST['username'];
  			
  			header('Location: index.php');
      }

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registrarse</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<script src="js/validate_password.js"></script>
	</head>
	<body class="sign_up_container">

		<a href="index.php" class="header_only_title">
			<div id="header_second_column_logo"></div>
			<div id="header_second_column_name">MOVIE ARCHIVE</div>
		</a>

		<div class="sign_up_card_div">

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="signup_form">

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
							<input class="sign_up_input" type="password" name="password" id="password_input">
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

			<div id="pswd_info">
			    <h4>Password must meet the following requirements:</h4>
			    <ul>
			        <li id="letter" class="invalid">Al menos <strong>una letra</strong></li>
			        <li id="capital" class="invalid">Al menos <strong>una letra mayúscula</strong></li>
			        <li id="number" class="invalid">Al menos <strong>un número</strong></li>
			        <li id="length" class="invalid">Al menos <strong>8 caracteres</strong></li>
			    </ul>
			</div>

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
