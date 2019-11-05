<?php
session_start();
?>

<!doctype html>

	<head>
		<title>Chequeo de logueo y creacion de sesion</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css" >
	</head>
	<body>
		<div class="container">
		
			<?php
			//incluye archivo de conexion a la base de datos
			include 'conn.php';	
			
			//llama a las variables de conexion
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Chequeo de conexion
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// data enviada desde el formulario de login.html 
			$email = $_POST['email']; 
			$password = $_POST['password'];
			
			// Query enviada a la basede datos
			$result = mysqli_query($conn, "SELECT Email, Password, Name FROM users WHERE Email = '$email'");
			
			// Variable $row guarda el resultado de la query
			$row = mysqli_fetch_assoc($result);
			
			// Variable $hash guarda el password hash en la base de datos
			$hash = $row['Password'];
			
			/* 
			password_Verify() verifica si el password ingresado por el usuario corresponde con el password hast en la base de datos. 
			Si todo esta ok la sesion es creada por cinco minutos.
			*/
			if (password_verify($_POST['password'], $hash)) {	
				
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $row['Name'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;						
				
				echo "<div class='alert alert-success mt-4' role='alert'><strong>Bienvenido!</strong> $row[Name]			
				<p><a href='edit-profile.php'>Editar perfil</a></p>	
				<p><a href='logout.php'>Finalizar sesion</a></p></div>";	
			
			} else {
				echo "<div class='alert alert-danger mt-4' role='alert'>Email o Contraseña incorrectos!
				<p><a href='login.html'><strong>Intente nuevamente</strong></a></p></div>";			
			}	
			?>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.js"</script>
		<script src="js/popper.min.js"</script>
		<script src="js/bootstrap.min.js"</script>	
	</body>
</html>