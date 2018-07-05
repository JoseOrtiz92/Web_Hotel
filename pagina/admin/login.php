<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Loguéate!</title>
		<!-- Bootstrap core CSS-->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom fonts for this template-->
		<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Custom styles for this template-->
		<link href="css/sb-admin.css" rel="stylesheet">
	</head>
	<body class="bg-dark">
		<div class="container">
			<div class="card card-login mx-auto mt-5">
				<div class="card-header">Inicio Sesión</div>
				<div class="card-body">
					<form action="" method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">Usuario</label>
							<input class="form-control" name="usuario" type="text" aria-describedby="emailHelp" placeholder="Usuario..." required>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Contraseña</label>
							<input class="form-control" name="password" type="password" placeholder="Contraseña..." required>
						</div>
						<div class="form-group">
							<div class="form-check">
								<label class="form-check-label">
								<input class="form-check-input" type="checkbox">Recordar contraseña</label>
							</div>
						</div>
						<button class="btn btn-primary btn-block" name="iniciar">Iniciar</button>
					</form>
					<div class="text-center">
         				<a class="d-block small mt-3" href="../index.php">Volver</a>
       				</div>
				</div>
			</div>
		</div>
		<?php
			$cont=0;
			session_start();
			clearstatcache();
			if (isset($_POST["iniciar"])){
				if (isset($_POST["usuario"]) and isset($_POST["password"])){
					$usuario = $_POST["usuario"];
					$password = $_POST["password"];

					$base=mysqli_connect("127.0.0.1","root","","hotelspa");
					$resul=mysqli_query($base,"SELECT usuario,password FROM usuarios");

					while ($reg = mysqli_fetch_assoc($resul)) {
						if (strtolower($reg["usuario"]) == strtolower($usuario) && $reg["password"] == $password){
							if (strtolower($usuario) == "admin"){
								$cont+=1;
							}
							else{
								$cont+=2;
							}
						}
					}
					if ($cont==1){
						header("Location: delete-reservas.php"); //administrador
					}
					elseif ($cont==2) {
						// poner sesion para pasarla a platano
						$_SESSION["usuario"]=$usuario;
						header("Location: ../index.php"); //usuarios
					}
					else{
						header("Location: fallar-password.php"); //falla password
					}			
				}
			}
		?>
			<!-- Bootstrap core JavaScript-->
			<script src="vendor/jquery/jquery.min.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
			<!-- Core plugin JavaScript-->
			<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	</body>
</html>
