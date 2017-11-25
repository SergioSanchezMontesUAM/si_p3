<?php

	try{
		$database = new PDO("pgsql:dbname=si1; host=localhost", "alumnodb", "alumnodb");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	session_start();

	$usernameORlogin = isset($_SESSION['username']) ? $_SESSION['username'] : "acceder";
	$signupORlogout = isset($_SESSION['username']) ? "cerrar sesión" : "registrarse";

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Movie archive</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	      rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="js/users_online.js"></script>
    <script src="js/search_box.js"></script>

	</head>
	<body>

		<div class="header">

			<div class="header_column">

				<form class="search_bar" method="get" action="search.php" id="form_search">
					<select name="genreid" form="form_search">
						<option value="0" selected>All categories</option>
						<?php
							$q_genres = $database->query("select * from genres order by genre asc");
							while($row = $q_genres->fetch(PDO::FETCH_OBJ)){
								echo "<option value=" . $row->genreid . ">" . $row->genre . "</option>";
							}
						?>
					</select>

				  <input type="text" placeholder="Buscar por título" name="movie"/>

				  <button type="submit" value="submit_search"></button>
				</form>

			</div>

			<div class="header_column">
				<a href="#"  id="header_second_column">
					<div id="header_second_column_logo"></div>
					<div id="header_second_column_name">MOVIE ARCHIVE</div>
				</a>
			</div>

			<div class="header_column">
				<div class="display_flex">
					<a href="login_or_profile.php" id="header_login">
							<div>
								<?php
									echo $usernameORlogin;
								?>
							</div>
					</a>
					<a href="signup_or_logout.php" id="header_signup">
						<div>
							<?php
								echo $signupORlogout;
							?>
						</div>
					</a>
					<a href="cart.php" id="header_cart">
						<i class="material-icons">shopping_cart</i>
					</a>
					<div id="online_users">
						<p id="num_users_online">0</p>
						<p>&nbsp; usuarios conectados</p>
					</div>
				</div>
			</div>
		</div>

  	<div class="menu">
  		<table class="menu_table">
				<th>Categories</th>
				<?php
					$q_genres = $database->query("select * from genres order by genre asc");
					while($row = $q_genres->fetch(PDO::FETCH_OBJ)){
						echo "<tr class='clickable-row' data-href='search.php?genreid=". $row->genreid . "'>
				    				<td>". $row->genre . "</td>
				    			</tr>";
					}
				?>
  		</table>
  	</div>

		<div class="content">

			<div id="last_movies_title">
				<h1>TOP VENTAS</h1>
			</div>

			<div class="last_movies_row">
				<?php
					$q_max_year = $database->query("select year from imdb_movies order by year desc limit 1");
					$max_year = $q_max_year->fetch(PDO::FETCH_OBJ);
			    $from_year = $max_year->year - 2;

					$q_top_ventas = $database->query("select * from gettopventas('" . $from_year . "')");

					while($row = $q_top_ventas->fetch(PDO::FETCH_OBJ)){
						echo "<div class='item_movie'>
										<h2>" . $row->agno . "</h2>
										<a href=#>
											<div class='movie'></div>
										</a>
										<div class='movie_title'>"
											. $row->pelicula .
										"</div>
										<div class='movie_price'>"
											. $row->ventas .
										"</div>
									</div>";
					}
				?>

		</div>

		<div class="footer">
			<div class="footer_left">
				<div class="footer_left_top">
					<a href="#" class="footer_link">
						<div>Ayuda</div>
					</a>
					<a href="#" class="footer_link">
						<div>Mi cuenta</div>
					</a>
					<a href="#" class="footer_link">
						<div>Sobre nosotros</div>
					</a>
					<a href="#" class="footer_link">
						<div>Política de cookies</div>
					</a>
				</div>
				<div class="footer_left_bottom">
					<div class="footer_icon">
						<img src="css/img/footer_icons/visa.png" alt="VISA">
					</div>
					<div class="footer_icon">
						<img src="css/img/footer_icons/mastercard.png" alt="MASTERCARD">
					</div>
					<div class="footer_icon">
						<img src="css/img/footer_icons/paypal.png" alt="PAYPAL">
					</div>
				</div>
			</div>

			<div class="footer_right">
				<div class="footer_right_top">
					<div id="moviearchive_hashtag">#moviearchive</div>
				</div>
				<div class="footer_right_bottom">
					<div class="footer_icon">
						<img src="css/img/footer_icons/facebook.png" alt="FACEBOOK">
					</div>
					<div class="footer_icon">
						<img src="css/img/footer_icons/twitter.png" alt="TWITTER">
					</div>
					<div class="footer_icon">
						<img src="css/img/footer_icons/instagram.png" alt="INSTAGRAM">
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
