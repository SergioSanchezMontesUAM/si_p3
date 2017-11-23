<?php

	if(isset($_POST['submit_log_in'])){

		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

    try{
      $database = new PDO("pgsql:dbname=si1; host=localhost", "alumnodb", "alumnodb");
      $q_username = $database->query("select username from customers");
      while($row = $q_username->fetch(PDO::FETCH_OBJ)){
  			if(strtolower($row->username) === $username){
          echo $row->username;
          $q_password = $database->query("select passwd from customers where username=" . $username);
          $row = $q_password->fetch(PDO::FETCH_OBJ));
          if($row->passwd === $password){
            echo $row->passwd;
            session_start();
            $_SESSION['username'] = $username;
            header('Location: index.php');
          }
        }
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
