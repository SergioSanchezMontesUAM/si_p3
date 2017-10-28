<?php

	$id = $_GET['id'];

	if(!isset($id)){
		header('Location: index.php');
		exit();
	}
	
	$catalogo = simplexml_load_file('catalogo.xml');
	
	$peliculas = $catalogo->xpath("/catalogo/pelicula[id=\"" . $id . "\"]");
	    
	foreach($peliculas as $pelicula){
		$title = $pelicula->titulo;
		$genre = $pelicula->categoria;
		$year = $pelicula->anno;
		$country = $pelicula->pais;
		$price = $pelicula->precio;
		$synopsis = $pelicula->sinopsis;
		$actors = $pelicula->actores;
		$videosANDphotos = $pelicula->fotosYvideos;
	}

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
			<a href="index.php" id="header_second_column">
				<div id="header_second_column_logo"></div>
				<div id="header_second_column_name">MOVIE ARCHIVE</div>
			</a>
		</div>
		<div class="header_column">
			<div id="header_third_column">
				<a href="#" id="header_login">
						<div>acceder</div>
				</a>
				<a href="sign_up.html" id="header_signup">
					<div>registrarse</div>
				</a>
				<a href="#" id="header_cart">
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

		<div class="detail_movie_info">

			<div class="detail_movie_picture"></div>

			<div class="detail_movie_info_2">

				<div id="detail_movie_title"> 
					<?php
						echo $title;
					?>
				</div>

				<div id="detail_movie_misc"> 
					<?php
						echo $genre . " | " . $year . " | " . $country;  
					?>
				</div>

				<div id="detail_movie_stars"> Estrellas</div>

				<div class="detail_movie_purchase_info">
					<div class="movie_price">
						<?php
							echo $price;
						?>
					</div>
					<div id="detail_cart_buy_btns">
						<a id="add_to_cart_btn" href="#">
							<div>Añadir al carrito</div>
						</a>
						<a id="buy_btn" href="#">
							<div>Comprar</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="detail_synopsis">
			<div class="movie_info_title">Sinopsis</div>
			<div class="movie_info_text">
				<?php
					echo $synopsis;
				?>
			</div>
		</div>

		<div class="detail_cast">
			<div class="movie_info_title">Reparto</div>
			<div id="movie_info_cast">
				<?php
					
					foreach ($actors->actor as $actor) {
						echo "<div class=\"movie_info_cast_item\"><div class=\"circle\"></div><div id=\"cast_item_text\">" . $actor->nombre . "</div></div>";
					}
				
				?>
				<!--<div class="movie_info_cast_item">
					<div class="circle"></div>
					<div id="cast_item_text">Actor</div>
				</div>-->
			</div>
		</div>

		<div class="detail_videos">
			<div class="movie_info_title">Vídeos y fotografías</div>
			<div id="videos">
				<div class="video"></div>
				<div class="video"></div>
				<div class="video"></div>
				<div class="video"></div>
			</div>
		</div>

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