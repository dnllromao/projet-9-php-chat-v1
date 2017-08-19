<?php 

	include 'pdo.php';

	session_start();

	if ( !empty($_POST) && !empty($_POST['msg']) ) :
		
		$msg = filter_input(INPUT_POST, "msg", FILTER_SANITIZE_STRING);
	 	try {

	 		$req = $db -> prepare("INSERT INTO msgs (content, moment, user_id) VALUES (:content, NOW(), (SELECT id FROM users WHERE pseudo = :pseudo))");
	 		$res = $req -> execute(array(
	 				'content' => $msg,
	 				'pseudo' => $_SESSION['pseudo']
	 		));

	 	} catch (Exception $e){
	 		die('Error: '.$e->getMessage());
	 	}


	endif;

?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../assets/css/style.css">
	</head>
	<body>
		<form action="" method="post">
			<textarea name="msg" id="" rows="5"></textarea>
			<input type="submit" value="send">
		</form>
	</body>
	</html>
	