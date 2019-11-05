<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Pagina de edicion de perfil</title>
	
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css" >
	</head>
  
  <body>      
    <?php
    if (isset($_SESSION['loggedin'])) {  
    }
    else {
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Usted necesita loguearse para acceder a esta pagina</h4>
        <p><a href='login.html'>Inicie sesion aqui</a></p></div>";
        exit;
    }
    // Chequea el tiempo desde que inicio sesion
    $now = time();           
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Su sesion ha finalizado</h4>
        <p><a href='login.html'>Inicie sesion aqui</a></p></div>";
        exit;
        }
    ?>

    <div class="container">
        <p>Bienvenido: <?php echo $_SESSION['name']; ?></p>
        <h3>Edite su perfil</h3>
        <ul>
            <li>Cambiar foto de perfil</li>
            <li>Cambiar Bio</li>
            <li>Cambiar password</li>
            <li>etc;</li>
        </ul>
        <p><a href="logout.php">Finalizar sesion</a></p>
    </div>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery.js"</script>
		<script src="js/popper.min.js"</script>
		<script src="js/bootstrap.min.js"</script>	
	</body>
</html>