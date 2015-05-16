<?php

	session_start();

	require 'connection.php';

	if ($_SERVER['REQUEST_METHOD'] != 'POST') 
		die('Geen post data gevonden!');
		
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	$cpassword = $_POST ['cpassword'];
	
	// Lijst met errors
	$error = Array();
	
	// Check of gebruikersnaam minder dan 3 tekens bevat
	if(strlen($username) < 3)
		$error [] = 'Gebruikersnaam is te kort!';
		
	// Check of gebruikersnaam alleen maar toegestane tekens gebruikt
	if(!preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/', $username))
		$error [] = 'Uw gebruikersnaam bevat tekens die niet toegestaan zijn!';
		
	// Check of wachtwoord min. 5 tekens heeft.
	if(strlen($password) < 5)
		$error [] = 'Wachtwoord is niet sterk genoeg!';
		
	// Check of wachtwoorden overeen komen
	if($password != $cpassword)
		$error [] = 'Wachtwoorden komen niet overeen!';
	
	// Selecteer alles met de gebruikersnaam $username
	$cquery = $pdo->prepare('SELECT * FROM users WHERE username=' . $username);
	$cquery->execute();
	
	// Als gebruikersnaam al bestaat
	if($cquery->rowCount() == 1)
		$error [] = 'Gebruikersnaam bestaat al!';
	
	// Als er geen errors zijn
	if(count($error) == 0){
		// In database zetten...
		$query = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
		$query->execute(
			array(
				':username' => $username,
				':password' => hash('sha1', $password)
			);
		);
		// stuur ze naar de index pagina, registreren succesvol
		header('Location: ' . $config['website_url'] . '/register.php?registered=succes');
	} else {
		// Zet errors in session variabel
		$_SESSION ['errors'] = $error;
		// stuur ze naar de index pagina, registreren failed
		header('Location: ' . $config['website_url'] . '/register.php?registered=failed');
	}
	
	$pdo = null;