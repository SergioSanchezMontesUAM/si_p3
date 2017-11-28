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

		<div class="cart_card">

				<?php

					if(isset($_SESSION['username'])){


						if($_SESSION['cart_is_empty']){
							echo "<div id='cart_empty_text'>Carrito vacío</div>";
						}

						else{

							echo "<table id='history_large_table'>
							<tr>
							<td colspan='3'>
							<h2>Carrito</h2>
							</td>
							</tr>


							<tr class='history_table_title_row'>
							<th>Item</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th></th>
							</tr>";

							$q_cart_items = $database->query("select prodid, movietitle, price, quantity from orderdetail natural join products natural join imdb_movies where orderid=" . $_SESSION['orderid']);

							while($row = $q_cart_items->fetch(PDO::FETCH_OBJ)){
								$title = $row->movietitle;
								$price = $row->price;
								$quantity = $row->quantity;

								$total_price += floatval($price);

								echo "<tr class=\"history_table_row\"><td class='display_flex'><div class='cart_movie_picture'></div><p class=\"cart_movie_title\">" . $title . "</p></td><td>$" . $price . "</td>";

								echo "<td><select>";
								for($i=1; $i<=10; $i++){
									if($i == $quantity){
										echo "<option selected>" . $i . "</option>";
									}
									else if($i == 10){
										echo "<option>+10</option>";
									}
									else{
										echo "<option>" . $i . "</option>";
									}
								}
								echo "</select></td><td><button onclick='removeItemFromCart(" . $_SESSION['orderid'] . ", " . $row->prodid . ")'>x</button></td></tr>";
							}

							echo '</table>';
						}

					}

					else{
						echo "<div id='cart_empty_text'>Debes iniciar sesión para acceder al carrito</div>";
					}
				?>



		</div>


		<div id="checkout_card">
			<p id="total_label">Total: &nbsp;<?php echo $total_price ?>€</p>
			<div class="detail_cart_buy_btns">
				<div class="add_to_cart_btn" onclick="continueShoppingScript()">
					Continuar comprando
				</div>
				<div class="buy_btn" onclick="checkoutScript()">
					Pagar
				</div>
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

	<script type="text/javascript">

		function continueShoppingScript(){
			window.location = "index.php"
		}

		function checkoutScript(){

		}

		function removeItemFromCart(orderid, prodid){
			$.ajax({
				type: 'POST',
				url: 'remove_item.php',
				data: {orderid:orderid,prodid:prodid},
				success: function(data){window.location.reload()}
			})
		}

	</script>
</body>
</html>
