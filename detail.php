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

	$prodid = $_GET['id'];

	if(!isset($prodid)){
		header('Location: index.php');
		exit();
	}

	$q_title_year_price = $database->query("select movietitle, year, price from imdb_movies natural join products natural join imdb_directormovies natural join imdb_directors natural join imdb_moviegenres natural join imdb_moviecountries where prodid=" . $prodid);
	$qr_title_year_price = $q_title_year_price->fetch(PDO::FETCH_OBJ);
	$movietitle = $qr_title_year_price->movietitle;
	$year = $qr_title_year_price->year;
	$price = $qr_title_year_price->price;

	$q_genres = $database->query("select genre from products natural join imdb_moviegenres natural join genres where prodid=" . $prodid);
	$genres = array();
	while ($genre = $q_genres->fetch(PDO::FETCH_OBJ)) {
		$genres[] = $genre->genre;
	}

	$q_countries = $database->query("select country from imdb_movies natural join products natural join imdb_moviecountries natural join countries where prodid=" . $prodid);
	$countries = array();
	while ($country = $q_countries->fetch(PDO::FETCH_OBJ)) {
		$countries[] = $country->country;
	}

	$q_directors = $database->query("select directorname from imdb_movies natural join imdb_directormovies natural join imdb_directors natural join products where prodid=" . $prodid);
	$directors = array();
	while ($director = $q_directors->fetch(PDO::FETCH_OBJ)) {
		$directors[] = $director->directorname;
	}

	$q_actors = $database->query("select actorname from imdb_movies natural join imdb_actormovies natural join imdb_actors natural join products where prodid=" . $prodid);
	$actors = array();
	while ($actor = $q_actors->fetch(PDO::FETCH_OBJ)) {
		$actors[] = $actor->actorname;
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="js/main.js"></script>
    <script src="js/users_online.js"></script>
		<script type="text/javascript">

			function addToCartScript(){

				<?php
						if($_SESSION['cart_is_empty']){
							$database->exec("insert into orders(shipmentstatusid, orderdate, customerid, tax) values (4, now()," . $_SESSION['customerid'] . ", 0)");
							$_SESSION['cart_is_empty'] = False;
							$orderid = $database->query("select currval('orders_orderidid_seq')")->fetch(PDO::FETCH_OBJ)->currval;
							$_SESSION['orderid'] = $orderid;

						}

						$q_cart_items = $database->query("select * from orderdetail where orderid=" . $_SESSION['orderid']);
						while($row = $q_cart_items->fetch(PDO::FETCH_OBJ)){
							if($row->prodid == $prodid){
								$database->exec("update orderdetail set quantity=" . ($row->quantity + 1) . " where orderid=" . $_SESSION['orderid'] . " and prodid=" . $prodid);
							}
						}

						if($database->exec("insert into orderdetail values (" . $_SESSION['orderid'] . "," . $prodid . "," . $price . ", 1)")){
							header("Refresh:0");
						}

				?>

				alert("Artículo añadido al carrito")
			}

			function buyScript(){
				addToCartScript()
				window.location = "cart.php"
			}

		</script>
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

		<div class="detail_movie_info">

			<div class="detail_movie_picture"></div>

			<div class="detail_movie_info_2">

				<div id="detail_movie_title">
					<?php
						echo $movietitle;
					?>
				</div>

				<div id="detail_movie_misc">
					<?php

						$prefix = $genreList = '';
						foreach ($genres as $genre){
						    $genreList .= $prefix . $genre;
						    $prefix = ', ';
						}

						echo $genreList . " | " . $year . " | ";

						$prefix = $countryList = '';
						foreach ($countries as $country){
						    $countryList .= $prefix . $country;
						    $prefix = ', ';
						}

						echo $countryList;
					?>
				</div>

				<div id="detail_movie_director">
					<?php
						$prefix = $directorList = '';
						foreach ($directors as $director){
								$directorList .= $prefix . $director;
								$prefix = ', ';
						}
						echo $directorList;
				 	?>
				</div>

				<div class="detail_movie_purchase_info">
					<div class="movie_price">
						<?php
							echo "$" . $price;
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
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi et egestas leo. Praesent eget libero sit amet elit maximus rutrum malesuada ut tortor. Suspendisse potenti. Vivamus vel gravida diam. Etiam vestibulum hendrerit nisi, sit amet molestie nibh pretium et. Integer quis nunc accumsan, pellentesque nisl in, commodo metus. Aliquam at urna nec urna luctus pretium. Nunc in sem vitae risus tincidunt egestas non a tortor. Vestibulum sed massa vel ante tristique commodo. Curabitur mollis laoreet magna in dapibus. Maecenas sit amet sem id nisl lobortis maximus.
			</div>
		</div>

		<div class="detail_cast">
			<div class="movie_info_title">Reparto</div>
			<div id="movie_info_cast">
				<?php

					$i=0;
					foreach ($actors as $actor) {
						echo "<div class=\"movie_info_cast_item\"><div class=\"circle\"></div><div id=\"cast_item_text\">" . $actor . "</div></div>";
						$i++;
						if($i == 5) break;
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


</body>
</html>
