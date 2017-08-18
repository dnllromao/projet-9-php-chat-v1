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
	<?php 
		if( !isset($_SESSION['pw']) &&  empty($_SESSION['pw'])) {
		?>
			<div class="signin">
				SignIn
				<form action="" method="post" autocomplete="off">
					<label>Pseudo<input type="text" name="pseudo" required></label>
					<label>Password<input type="password" name="pw" required></label>
					<input type="submit" value="signin" name="action">
				</form>
			</div>			
			<div class="signup">
			SignUp
				<form action="" method="post" autocomplete="off">
					<label>Pseudo<input type="text" name="pseudo" required></label>
					<label>Email<input type="email" name="email" required></label>
					<label>Password<input type="password" name="pw" required></label>
					<input type="submit" value="signup" name="action">
				</form>
			</div>

		<?php
		} else {
		?>
			<div class="signout">
			SignOUT
				<form action="" method="post">
					<input type="submit" value="signout" name="action">
				</form>
			</div>
			<div class="chat">
				<iframe src="inc/conversation.php" style="border:none;"></iframe>
				<form action="" method="post">
					<textarea name="msg" id="" cols="30" rows="10">	</textarea>
					<input type="submit" value="send" name="action">
				</form>
			</div>
		<?php
		}
	?>
	
</body>
</html>