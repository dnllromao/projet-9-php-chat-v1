<?php include 'pdo.php'; ?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv="refresh" content="5" url="<?= $_SERVER["HTTP_REFERER"];?>inc/conversation.php">
	</head>
	<body>
		<ul class="inner-content">
		<?php

		$req = $db -> query("SELECT * FROM (SELECT msgs.id AS id, msgs.content AS content, HOUR(msgs.moment) AS hour, MINUTE(msgs.moment) AS minutes, users.pseudo AS user FROM msgs INNER JOIN users ON msgs.user_id = users.id ORDER BY msgs.id DESC LIMIT 10) AS new ORDER BY id ASC");

		while ($row = $req -> fetch()) : ?>
		
			<li>
				<strong><?= $row['user']; ?></strong>
				[<?= $row['hour']; ?>:<?= $row['minutes']; ?>]
				<?= $row['content']; ?>
			</li>

		<?php endwhile; ?>

		</ul>
	</body>
	</html>

	
