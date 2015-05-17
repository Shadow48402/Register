<?php
	require 'config.php';
	try {
		// Maak connectie
		$pdo = new PDO('mysql:host=' . $config['mysql_host'] . ';dbname=' . $config['mysql_database'], $config['mysql_username'], $config['mysql_password']);
	} catch (PDOException $e) {
		// Errors? Print ze en stop de code!
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}