!DOCTYPE html>
<html>
<head>
	<title>Test sign up data</title>
</head>
<body>

	<?php 
		$username = $_REQUEST['username'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$gender = $_REQUEST['gender'];
		$credit_card_1 = $_REQUEST['credit_card_1'];
		$credit_card_2 = $_REQUEST['credit_card_2'];
		$credit_card_3 = $_REQUEST['credit_card_3'];
		$credit_card_4 = $_REQUEST['credit_card_4'];
		$about_me = $_REQUEST['about_me'];

		print("Username: $username\n");
		print("Email: $email\n");
		print("Password: $password\n");
		print("Gender: $gender\n");
		print("CC1: $credit_card_1\n");
		print("CC2: $credit_card_2\n");
		print("CC3: $credit_card_3\n");
		print("CC4: $credit_card_4\n");
		print("About me: $about_me\n");
		
	 ?>

</body>
</html>