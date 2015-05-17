<?php
	session_start();

	require 'connection.php';
	
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	
	$query = $pdo->prepare('SELECT password FROM users WHERE username=:username');
	$query->execute(
		Array(
			':username' => $username
		);
	);
	
	$error = Array();
	
	if($query->rowCount() == 1){
		foreach($query->fetchAll() as $val){
			if(hash('sha1', $password) != $val['password']){
				$error [] = 'Gegevens kloppen niet!';
				$user = $val['username'];
			}
		}
	} else {
		$error [] = 'Gegevens kloppen niet!';
	}
	
	if(count($error) == 0){
		$_SESSION ['user'] = $user;
		header('Location: ' . $config['website_url'] . '/login?login=succes');
	} else {
		$_SESSION ['errors'] = $error;
		header('Location: ' . $config['website_url'] . '/login?login=failed');
	}