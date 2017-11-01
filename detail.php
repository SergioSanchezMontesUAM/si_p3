<?php

	session_start();
	
	$usernameORlogin = isset($_SESSION['username']) ? $_SESSION['username'] : "acceder";
	$signupORlogout = isset($_SESSION['username']) ? "cerrar sesión" : "registrarse";
	
	
	$id = $_GET['id'];

	if(!isset($id)){
		header('Location: index.php');
		exit();
	}
	
	$catalogo = simplexml_load_file('catalogo.xml');
	
	$peliculas = $catalogo->xpath("/catalogo/pelicula[id=\"" . $id . "\"]");
	    
	foreach($peliculas as $pelicula){
		$title = $pelicula->titulo;
		$poster = $pelicula->poster;
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
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	      rel="stylesheet">
	    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	    <script src="js/main.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
  	    <script src="js/users_online.js"></script>
	</head>
<body>

	<div class="header">

		<div class="header_column">
			<form class="search_bar" method="get" action="search.php" id="form_search">
				<select name="genre" form="form_search">
					<option value="ninguno" selected>Todas las categorías</option>
					<option value="acction">Acción</option>
					<option value="aventura">Aventura</option>
					<option value="belico">Bélico</option>
					<option value="ciencia_ficcion">Ciencia ficción</option>
					<option value="dramatico">Dramático</option>
					<option value="infantil">Infantil</option>
					<option value="misterio">Misterio</option>
					<option value="romantico">Romance</option>
					<option value="terror">Terror</option>
				</select>
		
			  <input type="text" placeholder="Buscar por título" name="movie"/>
		
			  <button type="submit" value="submit_search"></button>
			</form>
		</div>
		<div class="header_column">
			<a href="index.php" id="header_second_column">
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
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
        					<path fill="#ffffff" d="M14.04,12H10V11H5.5A3.5,3.5 0 0,1 2,7.5A3.5,3.5 0 0,1 5.5,4C6.53,4 7.45,4.44 8.09,5.15C8.5,3.35 10.08,2 12,2C13.92,2 15.5,3.35 15.91,5.15C16.55,4.44 17.47,4 18.5,4A3.5,3.5 0 0,1 22,7.5A3.5,3.5 0 0,1 18.5,11H14.04V12M10,16.9V15.76H5V13.76H19V15.76H14.04V16.92L20,19.08C20.58,19.29 21,19.84 21,20.5A1.5,1.5 0 0,1 19.5,22H4.5A1.5,1.5 0 0,1 3,20.5C3,19.84 3.42,19.29 4,19.08L10,16.9Z" />
    					</svg>
    				</td>
    				<td>Acción</td>
    			</tr>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
    					    <path fill="#ffffff" d="M15,19L9,16.89V5L15,7.11M20.5,3C20.44,3 20.39,3 20.34,3L15,5.1L9,3L3.36,4.9C3.15,4.97 3,5.15 3,5.38V20.5A0.5,0.5 0 0,0 3.5,21C3.55,21 3.61,21 3.66,20.97L9,18.9L15,21L20.64,19.1C20.85,19 21,18.85 21,18.62V3.5A0.5,0.5 0 0,0 20.5,3Z" />
    					</svg>
    				</td>
    				<td>Aventura</td>
    			</tr>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
    					    <path fill="#ffffff" d="M7,5H23V9H22V10H16A1,1 0 0,0 15,11V12A2,2 0 0,1 13,14H9.62C9.24,14 8.89,14.22 8.72,14.56L6.27,19.45C6.1,19.79 5.76,20 5.38,20H2C2,20 -1,20 3,14C3,14 6,10 2,10V5H3L3.5,4H6.5L7,5M14,12V11A1,1 0 0,0 13,10H12C12,10 11,11 12,12A2,2 0 0,1 10,10A1,1 0 0,0 9,11V12A1,1 0 0,0 10,13H13A1,1 0 0,0 14,12Z" />
    					</svg>
    				</td>
    				<td>Bélico</td>
    			</tr>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
    					    <path fill="#ffffff" d="M12,2A2,2 0 0,1 14,4C14,4.74 13.6,5.39 13,5.73V7H14A7,7 0 0,1 21,14H22A1,1 0 0,1 23,15V18A1,1 0 0,1 22,19H21V20A2,2 0 0,1 19,22H5A2,2 0 0,1 3,20V19H2A1,1 0 0,1 1,18V15A1,1 0 0,1 2,14H3A7,7 0 0,1 10,7H11V5.73C10.4,5.39 10,4.74 10,4A2,2 0 0,1 12,2M7.5,13A2.5,2.5 0 0,0 5,15.5A2.5,2.5 0 0,0 7.5,18A2.5,2.5 0 0,0 10,15.5A2.5,2.5 0 0,0 7.5,13M16.5,13A2.5,2.5 0 0,0 14,15.5A2.5,2.5 0 0,0 16.5,18A2.5,2.5 0 0,0 19,15.5A2.5,2.5 0 0,0 16.5,13Z" />
    					</svg>
    				</td>
    				<td>Ciencia ficción</td>
    			</tr>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
    					    <path fill="#ffffff" d="M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z" />
    					</svg>
    				</td>
    				<td>Dramático</td>
    			</tr>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
        					<path fill="#ffffff" d="M18.5,4A2.5,2.5 0 0,1 21,6.5A2.5,2.5 0 0,1 18.5,9A2.5,2.5 0 0,1 16,6.5A2.5,2.5 0 0,1 18.5,4M4.5,20A1.5,1.5 0 0,1 3,18.5A1.5,1.5 0 0,1 4.5,17H11.5A1.5,1.5 0 0,1 13,18.5A1.5,1.5 0 0,1 11.5,20H4.5M16.09,19L14.69,15H11L6.75,10.75C6.75,10.75 9,8.25 12.5,8.25C15.5,8.25 15.85,9.25 16.06,9.87L18.92,18C19.2,18.78 18.78,19.64 18,19.92C17.22,20.19 16.36,19.78 16.09,19Z" />
    					</svg>
    				</td>
    				<td>Infantil</td>
    			</tr>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
        					<path fill="#ffffff" d="M12,3C9.31,3 7.41,4.22 7.41,4.22L6,9H18L16.59,4.22C16.59,4.22 14.69,3 12,3M12,11C9.27,11 5.39,11.54 5.13,11.59C4.09,11.87 3.25,12.15 2.59,12.41C1.58,12.75 1,13 1,13H23C23,13 22.42,12.75 21.41,12.41C20.75,12.15 19.89,11.87 18.84,11.59C18.84,11.59 14.82,11 12,11M7.5,14A3.5,3.5 0 0,0 4,17.5A3.5,3.5 0 0,0 7.5,21A3.5,3.5 0 0,0 11,17.5C11,17.34 11,17.18 10.97,17.03C11.29,16.96 11.63,16.9 12,16.91C12.37,16.91 12.71,16.96 13.03,17.03C13,17.18 13,17.34 13,17.5A3.5,3.5 0 0,0 16.5,21A3.5,3.5 0 0,0 20,17.5A3.5,3.5 0 0,0 16.5,14C15.03,14 13.77,14.9 13.25,16.19C12.93,16.09 12.55,16 12,16C11.45,16 11.07,16.09 10.75,16.19C10.23,14.9 8.97,14 7.5,14M7.5,15A2.5,2.5 0 0,1 10,17.5A2.5,2.5 0 0,1 7.5,20A2.5,2.5 0 0,1 5,17.5A2.5,2.5 0 0,1 7.5,15M16.5,15A2.5,2.5 0 0,1 19,17.5A2.5,2.5 0 0,1 16.5,20A2.5,2.5 0 0,1 14,17.5A2.5,2.5 0 0,1 16.5,15Z" />
    					</svg>
    				</td>
    				<td>Misterio</td>
    			</tr>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
    					    <path fill="#ffffff" d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
    					</svg>
    				</td>
    				<td>Romántico</td>
    			<tr>
    				<td>
    					<svg style="width:24px;height:24px" viewBox="0 0 24 24">
    					    <path fill="#ffffff" d="M12,2A9,9 0 0,0 3,11C3,14.03 4.53,16.82 7,18.47V22H9V19H11V22H13V19H15V22H17V18.46C19.47,16.81 21,14 21,11A9,9 0 0,0 12,2M8,11A2,2 0 0,1 10,13A2,2 0 0,1 8,15A2,2 0 0,1 6,13A2,2 0 0,1 8,11M16,11A2,2 0 0,1 18,13A2,2 0 0,1 16,15A2,2 0 0,1 14,13A2,2 0 0,1 16,11M12,14L13.5,17H10.5L12,14Z" />
    					</svg>
    				</td>
    				<td>Terror</td>
    			</tr>
    		</table>
    	</div>
    	
	<div class="content">

		<div class="detail_movie_info">

			<img class="detail_movie_picture" src="<?php echo $poster ?>"></img>

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
					<div class="detail_cart_buy_btns">
						<div class="add_to_cart_btn" onclick="addToCartScript()">
							Añadir al carrito
						</div>
						<div class="buy_btn" onclick="buyScript()">
							Comprar
						</div>
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
	
		<script>
		
			function addToCartScript(){
				if ($.cookie('cart_items_cookie') == null){
					var cartItems = [];
				}
				else{
					var cartItems =  JSON.parse($.cookie('cart_items_cookie'));
				}
				
				cartItems.push("<?php echo $id; ?>");
				$.cookie('cart_items_cookie', JSON.stringify(cartItems));
				
				alert("Artículo añadido al carrito")
			}
			
			function buyScript(){
				addToCartScript()
				window.location = "cart.php"
			}
			
		</script>
</body>
</html>