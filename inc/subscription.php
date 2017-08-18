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
		'msg' => FILTER_SANITIZE_STRING
	);
	// ? how to check errors with this fuctions

	$inputs = filter_input_array(INPUT_POST, $args);
	//var_dump($inputs);

	switch ($_POST['action']) {
		case 'signin':

			echo 'Are you tryin g to sign in , mdr';

			try {
				// prepare req
				$req = $db -> prepare("SELECT pw FROM users WHERE pseudo = ?");
				$req -> execute(array($inputs['pseudo']));
				$hash = $req -> fetchColumn();
				$req->closeCursor();
				
			} catch (Exception $e){
				die('Error: '.$e->getMessage());
			}


			if (password_verify($inputs['pw'], $hash)) { 
			    echo 'Password is valid!'; 
			    // if user registed in db save value in session
			    $_SESSION['pseudo'] = $inputs['pseudo'];
			    $_SESSION['pw'] = $inputs['pw'];

			} else { 
			    echo 'Invalid password.'; 
			} 

			break;

		case 'signup':
			// create password-hash

			//$inputs['pw'] = PDO::quote($inputs['pw']);
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


			// if user registed in db save value in session
			$_SESSION['pseudo'] = $inputs['pseudo'];
			$_SESSION['pw'] = $inputs['pw'];

			break;

		case 'signout':

			session_destroy();
			break;

		case 'send':

			$inputs['msg'] = trim($inputs['msg']);

			if(! empty($inputs['msg'])) {
			 	try {

			 		$req = $db -> prepare("INSERT INTO msgs (content, moment, user_id) VALUES (:content, NOW(), (SELECT id FROM users WHERE pseudo = :pseudo))");
			 		$res = $req -> execute(array(
			 				'content' => $inputs['msg'],
			 				'pseudo' => $_SESSION['pseudo']
			 			));
			 	} catch (Exception $e){
			 		die('Error: '.$e->getMessage());
			 	}
			}
			
			break;

		default:
			# code...
			break;
	}

	
	

	
		
	