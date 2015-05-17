<!DOCTYPE html>

<html>
	<head>
	
	</head>
	
	<body>
		<?php
		session_start();
		if(isset($_GET ['registered'])){
			if($_GET ['registered'] == 'succes')
				echo '<h3>Registratie succesvol!</h3>';
			elseif($_GET ['registered'] == 'failed'){
				$array = $_SESSION ['errors'];
				for($i = 0; $i < count(array); $i++){
					echo '<strong>Fout '. $i . ': </strong>' . $array[$i] . '<br />';
				}
			} else {
				die('Deze value kennen we niet...');
			}
		} else {
		?>
			<form action="registerPost.php" method="post">
				<label for="username">Gebruikersnaam</label>
				<input type="text" name="username" id="username" />
				<label for="password">Wachtwoord</label>
				<input type="password" name="password" id="password" />
				<label for="cpassword">Bevestig wachtwoord</label> 
				<input type="password" name="cpassword" id="cpassword" />
				<input type="submit" />
			</form>
		<?php } ?>
	</body>
</html>