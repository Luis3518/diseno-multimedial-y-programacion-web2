<!doctype html>

  <head>
    <title>Crear cuenta en base de datos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css" >
	</head>
<body>

<div class="container">

	<?php

	include 'conn.php'; //incluye archivo de conexion a la base de datos

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //llama a las variables de conexion

	// Chequeo de conexion
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Query que chequea si el mail ya existe
	$checkEmail = "SELECT * FROM users WHERE Email = '$_POST[email]' ";

	// La variable $result y $count se usan para cguardar el resultado de la query
	$result = $conn-> query($checkEmail);

	$count = mysqli_num_rows($result);

	// Si count == 1 quiere decir que el email ya existe en la base 
	if ($count == 1) {
	echo "<div class='alert alert-warning mt-4' role='alert'>
					<p>El email ingresado ya fue registrado anteriormente</p>
					<p><a href='login.html'>Inicie sesion aqui</a></p>
				</div>";
	} else {	
	
	//	Si el email no existe, los datos del formulario son guardados en las variables 
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	
	// password_hash() es una funcion que convierte la clave en un hash antes de ser enviado a la base de datos 
	$passHash = password_hash($pass, PASSWORD_DEFAULT);
	
	// Query que envia las variables a la base de datos
	$query = "INSERT INTO users (Name, Email, Password) VALUES ('$name', '$email', '$passHash')";

	if (mysqli_query($conn, $query)) {
		echo "<div class='alert alert-success mt-4' role='alert'><h3>Su cuenta ha sido creada</h3>
		<a class='btn btn-outline-primary' href='login.html' role='button'>Login</a></div>";		
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($conn);
		}	
	}	
	mysqli_close($conn);
	?>
</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.js"</script>
		<script src="js/popper.min.js"</script>
		<script src="js/bootstrap.min.js"</script>	
	 </body>
</html>