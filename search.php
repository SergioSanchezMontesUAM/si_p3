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

 $movie = $_GET["movie"];
 $genreid = $_GET["genreid"];

  //$movie = $argv[2];
 	//$genreid = $argv[1];

 if($genreid != 0) $genre = $database->query("select * from genres where genreid=". $genreid)->fetch(PDO::FETCH_OBJ)->genre;


  function normalizar($cadena){

	    //Ahora reemplazamos las letras
	    $cadena = str_replace(
	        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
	        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
	        $cadena
	    );

	    $cadena = str_replace(
	        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
	        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
	        $cadena );

	    $cadena = str_replace(
	        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
	        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
	        $cadena );

	    $cadena = str_replace(
	        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
	        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
	        $cadena );

	    $cadena = str_replace(
	        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
	        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
	        $cadena );

	    $cadena = str_replace(
	        array('ñ', 'Ñ', 'ç', 'Ç'),
	        array('n', 'N', 'c', 'C'),
	        $cadena
	    );

	    $cadena = str_replace(' ', '_', $cadena);

	    return $cadena;
	}

?>

<!DOCTYPE html>
<html>

    <head>
      <meta charset="utf-8">
      <title>
          <?php

            if($genreid == 0){
                echo($movie . " | Movie Archive");
            }
            else{
            	if(is_null($movie)){
                	echo($genre . " | Movie Archive");
            	}
            	else{
								echo($genre . ": " . $movie . " | Movie Archive");
            	}
            }

          ?>
      </title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
		      rel="stylesheet">
	    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
	    <script src="js/main.js"></script>
	    <script src="js/users_online.js"></script>

    </head>

    <body>

		<div class="header">

			<div class="header_column">
				<form class="search_bar" method="get" action="search.php" id="form_search">
					<select name="genre" form="form_search">
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
				<a href="index.php"  id="header_second_column">
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

	  	<?php
				if($genreid != 0) $genre = $database->query("select * from genres where genreid=". $genreid)->fetch(PDO::FETCH_OBJ)->genre;

				echo " <div id='last_movies_title'>
							 	<h1>" . strtoupper($genre) . "</h1>
							 </div>";

			 	//Buscando solo por categoria (viene del menu lateral)
   			if(is_null($movie)){
					$q_movies = $database->query("select movietitle, price, description from imdb_movies natural join imdb_moviegenres natural join products where genreid=" . $genreid);

					$i = 0;
					while($row = $q_movies->fetch(PDO::FETCH_OBJ)){
						$movie_html .= "<div class='item_movie'>
										<h2>" . $row->description . "</h2>
										<a href=#>
											<div class='movie'></div>
										</a>
										<div class='movie_title'>"
											. $row->movietitle .
										"</div>
										<div class='movie_price'>$"
											. $row->price .
										"</div>
									</div>";
						$i++;
						if($i%3 === 0) {
							echo "<div class=\"last_movies_row\">" . $movie_html . "</div>";
							$movie_html = "";
						}
					}

					if($i%3 !== 0){
						echo "<div class=\"last_movies_row\">" . $movie_html . "</div>";
					}
				}

				else{


					if($genreid == 0){
						$q_movies = $database->query("select prodid, movietitle, price, description from imdb_movies natural join products natural join imdb_moviegenres where movietitle like '%" . strtolower($movie) . "%' or movietitle like '%" . strtoupper($movie) . "%' or movietitle like '%" . ucfirst($movie) . "%'");
						echo "<div class='results_text'><p>Resultados para &nbsp;</p><p id='movie_result'>" . $movie . "</p><p>&nbsp;:</p></div>";
					}
					else{

						$q_movies = $database->query("select prodid, movietitle, price, description, genreid from imdb_movies natural join products natural join imdb_moviegenres where genreid=" . $genreid . " and (movietitle like '%" . strtolower($movie) . "%' or movietitle like '%" . strtoupper($movie) .  "%' or movietitle like '%" . ucfirst($movie) . "%')");
						echo "<div class='results_text'><p>Resultados para &nbsp;</p><p id='movie_result'>" . $movie . "</p><p>&nbsp;en&nbsp;</p><p class=\'bold'>" . $genre . "</p><p>: </p></div>";
					}

					$i = 0;
					while($row = $q_movies->fetch(PDO::FETCH_OBJ)){
						$movie_html .=  "<div class=\"item_movie\"><a href=detail.php?id=" . $row->prodid . "><img class='movie'></a><div class='movie_title'>" . $row->movietitle . "</div><div class='movie_price'>" . $row->price . "</div></div>";
						$i++;
						if($i%3 === 0) {
							echo "<div class='last_movies_row'>" . $movie_html . "</div>";
							$movie_html = "";
						}
					}

					if($i%3 !== 0){
						echo "<div class=\"last_movies_row\">" . $movie_html . "</div>";
					}

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
