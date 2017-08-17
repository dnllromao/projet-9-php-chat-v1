<?php 

	include 'pdo.php';

	if (empty($_POST)) {
		return;
	}

	//var_dump($_POST);

	// check if there are any input empty
	$error = false;
	foreach ($_POST as $key => $value) {
		if(empty($value)) {
			echo "Vous avez oublié de remplir le champ $key";
		}
	}

	//var_dump($error);

	// sanitization 
	if($error) { 
		return;
	}

	$args = array(
		'pseudo' => FILTER_SANITIZE_STRING,
		'email' => FILTER_VALIDATE_EMAIL,
		'pw' => FILTER_SANITIZE_STRING,
	);

	$inputs = filter_input_array(INPUT_POST, $args);
	//var_dump($inputs);

	// create password-hash
	$inputs['pw'] = password_hash($inputs['pw'], PASSWORD_DEFAULT);
	//var_dump($inputs['pw']);

	try {
		// ! check if email or user already exists

		$req = $db -> prepare("INSERT INTO users (pseudo, email, pw) VALUES (:pseudo, :email, :pw)");
		$res = $req -> execute(array(
				'pseudo' => $inputs['pseudo'],
				'email' => $inputs['email'],
				'pw' => $inputs['pw']
			));
		var_dump($res);
	} catch (Exception $e){
		die('Error: '.$e->getMessage());
	}


	// if user register in db save value in session
	$_SESSION['pseudo'] = $inputs['pseudo'];
	$_SESSION['pw'] = $inputs['pw'];