<?php

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
</head>
<body>

	<div class="header">

		<div class="header_column">
			<div id="header_first_column">
				<input class="header_search_input" type="search" placeholder="buscar">
			</div>
		</div>
		<div class="header_column">
			<a href="#"  id="header_second_column">
				<div id="header_second_column_logo"></div>
				<div id="header_second_column_name">MOVIE ARCHIVE</div>
			</a>
		</div>
		<div class="header_column">
			<div id="header_third_column">
				<a href="log_in.html" id="header_login">
						<div>
							<?php
								echo $usernameORlogin;
							?>
						</div>
				</a>
				<a href="sign_up.html" id="header_signup">
					<div>
						<?php
							echo $signupORlogout;
						?>
					</div>
				</a>
				<a href="cart.html" id="header_cart">
					<div id="cart_btn"></div>
				</a>
			</div>
		</div>
	</div>

	<div class="menu">
		<table class="menu_table">
			<tr>
				<td>
					<img src="css/img/menu_icons/explosion.png" alt="-">
				</td>
				<td>Acción</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/backpack.png" alt="-">
				</td>
				<td>Aventura</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/gun.png" alt="-">
				</td>
				<td>Bélico</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/alien.png" alt="-">
				</td>
				<td>Ciencia ficción</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/drama.png" alt="-">
				</td>
				<td>Dramático</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/children.png" alt="-">
				</td>
				<td>Infantil</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/mistery.png" alt="-">
				</td>
				<td>Misterio</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/heart.png" alt="-">
				</td>
				<td>Romántico</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/thriller.png" alt="-">
				</td>
				<td>Suspense</td>
			</tr>
			<tr>
				<td>
					<img src="css/img/menu_icons/freddy.png" alt="-">
				</td>
				<td>Terror</td>
			</tr>
		</table>
	</div>

	<div class="content">

		<div id="last_movies_title">
			<h1>ÚLTIMAS PELÍCULAS</h1>
		</div>

		<?php
			
			if(file_exists('catalogo.xml')){
				$catalogo = simplexml_load_file('catalogo.xml');
				$i = 0;
				foreach ($catalogo->pelicula as $pelicula) {
					$movie_html .=  "<div class=\"item_movie\"><a href=\"detail.php?id=" . $pelicula->id . "\"><div class=\"movie\"></div></a><div class=\"movie_title\">" . $pelicula->titulo . "</div><div class=\"movie_price\">" . $pelicula->precio . "</div></div>";
					$i++;
					if($i%3 === 0) {
						echo "<div class=\"last_movies_row\">" . $movie_html . "</div>";
						$movie_html = "";
					}
				}
			}
		?>
	<!--	<div class="last_movies_row">
			<div class="item_movie">
				<a href="detail.html">
					<div class="movie"></div>
				</a>
				<div class="movie_title">Título</div>
				<div class="movie_price">Precio</div>
			</div>
			<div class="item_movie">
				<a href="detail.html">
					<div class="movie"></div>
				</a>
				<div class="movie_title">Título</div>
				<div class="movie_price">Precio</div>
			</div>
			<div class="item_movie">
				<a href="detail.html">
					<div class="movie"></div>
				</a>
				<div class="movie_title">Título</div>
				<div class="movie_price">Precio</div>
			</div>
		</div>-->
		
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