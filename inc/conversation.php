<?php 

	namespace Emojione; // remenber this php case

	include 'pdo.php';
	include __DIR__.'/emojione/php/autoload.php';

	$client = new Client(new Ruleset());
	$client->ascii = true;
	$client->riskyMatchAscii = true;

	$req = $db -> query("SELECT * FROM (SELECT msgs.id AS id, msgs.content AS content, HOUR(msgs.moment) AS hour, MINUTE(msgs.moment) AS minutes, users.pseudo AS user FROM msgs INNER JOIN users ON msgs.user_id = users.id ORDER BY msgs.id DESC LIMIT 10) AS new ORDER BY id ASC");

?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv="refresh" content="5" url="<?= $_SERVER["HTTP_REFERER"];?>">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojione/2.2.7/assets/css/emojione.min.css">
		
	</head>
	<body>
		<ul class="inner-content">
		<?php

		while ($row = $req -> fetch()) : ?>
		
			<li>
				<strong><?= $row['user']; ?></strong>
				[<?= $row['hour']; ?>:<?= $row['minutes']; ?>]
				<?= $client->shortnameToImage($row['content']); ?>
			</li>

		<?php endwhile; ?>

		</ul>
	</body>
	</html>

	
