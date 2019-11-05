<!doctype html>
<html lang="en">
	<head>		
    	<title>Recuperacion de contraseña</title>
    	<!-- Required meta tags -->
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
  </head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			
			<?php
			include 'conn.php';
			
			$email = $_POST['email'];				
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Chequea conexion con la base de datos
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
				
			$sql = "SELECT Email, Password FROM users WHERE Email='$email'";				
			$result = mysqli_query($conn, $sql);
				
			if (mysqli_num_rows($result) > 0) {				
				$row = mysqli_fetch_assoc($result);
				
				$subject = "Your password for PHP Login";
				$body = "Your password is:" . $row['Password'];
				
				$headers = 'From: youremail@mail.com' . "\r\n" .
				'Reply-To: youremail@mail.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				
				mail($email, $subject, $body, $headers);				
				
				echo "<div class='alert alert-success alert-dismissible mt-4' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button>

				<p>Correo enviado, por favor revise su email</p>
				<p><a class='alert-link' href=login.html>Login</a></p></div>";
			} else {
				echo "Ese email no se encuentra en la base de datos.";
			}
			?>
		</div>
	</div>
</div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.js"</script>
		<script src="js/popper.min.js"</script>
		<script src="js/bootstrap.min.js"</script>		
	</body>
</html>