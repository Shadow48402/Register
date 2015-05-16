<!DOCTYPE html>

<html>
	<head>
	
	</head>
	
	<body>
		<?php
			if(isset($_SESSION['user']))
				echo 'Hello ' . $_SESSION['user'];
		?>
		<a href="login.php">Login</a> | <a href="register.php">Registreer</a> 
	</body>
</html>