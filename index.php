<?php 
	session_start();
	
	include 'inc/subscription.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Php Chat V1</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="signup">
		<form action="" method="post" autocomplete="off">
			<label>Pseudo<input type="text" name="pseudo" required></label>
			<label>Email<input type="email" name="email" required></label>
			<label>Password<input type="password" name="pw" required></label>
			<input type="submit" value="Envoyer">
		</form>
	</div>
</body>
</html>