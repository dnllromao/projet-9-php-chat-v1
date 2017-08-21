<?php

	try {
		$db = new PDO('mysql:host=localhost;dbname=chat;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e){
		die('Error: '.$e->getMessage());
	}