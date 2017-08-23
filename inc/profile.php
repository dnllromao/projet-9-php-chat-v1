<?php 
	include 'pdo.php';
	include '../lib/claviska/SimpleImage.php';

	echo '<pre>';
	var_dump($_FILES);
	echo '</pre>';

	if(!empty($_POST) && !empty($_FILES)) {

		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
	    //var_dump($check);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }

	    // Check if file already exists
	    $target_dir = "../uploads/";
	    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
	    var_dump($target_file);
	    if (file_exists($target_file)) {
	        echo "Sorry, file already exists.";
	        $uploadOk = 0;
	    }

	    // Allow certain file formats
	    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	    var_dump($imageFileType);
	    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	    && $imageFileType != "gif" ) {
	        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	        $uploadOk = 0;
	    }

	    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
	            echo "The file ". basename( $_FILES["avatar"]["name"]). " has been uploaded.";
	        } else {
	            echo "Sorry, there was an error uploading your file.";
	        }

	    try {
	      // Create a new SimpleImage object
	      $image = new \claviska\SimpleImage();

	      // Magic! ✨
	      $image
	        ->fromFile('../')                     // load image.jpg
	        ->toFile('new-image.png', 'image/png')      // convert to PNG and save a copy to new-image.png

	      // And much more! 💪
	    } catch(Exception $err) {
	      // Handle errors
	      echo $err->getMessage();
	    }

	}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>User-Profile</title>
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		Select image to upload:
		<input type="file" name="avatar">
		<input type="submit" value="Upload Image" name="submit">
	</form>
</body>
</html>