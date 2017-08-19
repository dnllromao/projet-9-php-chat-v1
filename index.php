<?php 
	session_start();

	include 'inc/login.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Php Chat V1</title>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="page-wrap">
	<?php if( !isset($_SESSION['pw']) &&  empty($_SESSION['pw'])) : ?>
		<div class="error"><?= show_error(); ?></div>
		<div class="sign-wrapper">
			<div class="signin">
				<form action="" method="post" autocomplete="off" novalidate>
					<fieldset>
						<legend>SignIn</legend>
						Pseudo<input type="text" name="pseudo" required>
						Password<input type="password" name="pw" required>
						<input type="submit" value="signin" name="action">
					</fieldset>
				</form>
			</div>			
			<div class="signup">
				<form action="" method="post" autocomplete="off" novalidate>
					<fieldset>
						<legend>SignUp</legend>
						Pseudo<input type="text" name="pseudo" required>
						Email<input type="email" name="email" required>
						Password<input type="password" name="pw" required>
						<input type="submit" value="signup" name="action">
					</fieldset>
				</form>
			</div>
		</div>

	<?php else : ?>

		<div class="signout">
			<p>Hello, <?= $_SESSION['pseudo']; ?></p>
			<form action="" method="post">
				<input type="submit" value="signout" name="action">
			</form>
		</div>
		<div class="chat">
			<iframe src="inc/conversation.php" class="frame"></iframe>
			<iframe src="inc/input.php" class="frame" id="input" frameBorder="0"></iframe>
		</div>

	<?php endif; ?>
	</div>
</body>
</html>