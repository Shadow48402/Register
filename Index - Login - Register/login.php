<!DOCTYPE html>

<html>

	<head>

	</head>

	<body>
		<?php
			if(isset($_GET ['login'])){
				if($_GET ['login'] == 'succes')
					echo '<h3>Succesvol ingelogd!</h3>';
				elseif($_GET ['login'] == 'failed'){
					$array = $_SESSION ['errors'];
					for($i = 0; $i < count($array); $i++){
						echo '<strong>Fout '. $i . ': </strong>' . $array[$i] . '<br />';
					}
				}
			} else {
		?>
			<form action="loginPost.php" method="post">
				<label for="username">Gebruikersnaam</label>
				<input type="text" name="username" id="username" />
				<label for="password">Wachtwoord</label>
				<input type="password" name="password" id="password" />
				<input type="submit" />
			</form>
		<?php } ?>
	</body>

</html>