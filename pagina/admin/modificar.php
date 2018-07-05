g<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Modificar Usuario</title>
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="css/sb-admin.css" rel="stylesheet">
	</head>
	<body class="bg-dark">
		<div class="container">
			<div class="card card-register mx-auto mt-5">
				<div class="card-header">Modificar Cuenta</div>
				<div class="card-body">
					<form action="" method="POST">
						<div class="form-group">
							<div class="form-row">
								<div class="col-md-6">
									<label for="exampleInputName">Nombre</label>
									<input class="form-control"  name="nombre" type="text" pattern="[a-zA-Záéíóú'ü\s]+" aria-describedby="nameHelp" value='<?php session_start(); echo $_SESSION["nombre"]; ?>' placeholder="Nombre" required>
								</div>
								<div class="col-md-6">
									<label for="exampleInputLastName">Dirección</label>
									<input class="form-control" name="direccion" value='<?php echo $_SESSION["direccion"]; ?>' type="text" aria-describedby="nameHelp" placeholder="Direccion" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="form-row">
								<div class="col-md-6">
									<label for="exampleInputName">Teléfono</label>
									<input class="form-control" minlength="12" maxlength="12" value='<?php echo $_SESSION["telefono"]; ?>' pattern="[+]{1}[0-9]{11}" name="telefono" type="text" aria-describedby="nameHelp" placeholder="+34..." required>
								</div>
								<div class="col-md-6">
									<label for="exampleInputLastName">Saldo</label>
									<input class="form-control" name="saldo" type="text" value='<?php echo $_SESSION["saldo"]; ?>' minlength="0" maxlength="11" pattern="[0-9]{0,11}" aria-describedby="nameHelp" placeholder="Por defecto 200€">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="form-row">
								<div class="col-md-6">
									<label  for="exampleInputPassword1">Usuario</label><br>
									<label  for="exampleInputPassword1"> <?php echo $_SESSION["usuario"]; ?> </label>
								</div>
								<div class="col-md-6">
									<label for="exampleConfirmPassword">Contraseña</label>
									<input class="form-control" minlength="4" maxlength="4" value='<?php echo $_SESSION["password"]; ?>' pattern="[0-9]{4}" name="password" type="text" placeholder="4 Dígitos numéricos" required>
								</div>
							</div>
						</div>
						<button class="btn btn-primary btn-block" name="modificar">Modificar</button>
					</form>
					<div class="text-center">
						<a class="d-block small mt-3" href="modificar-tabla.php">Volver</a>
					</div>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST["modificar"])) {
				if (isset($_POST["nombre"]) && isset($_POST["direccion"]) && isset($_POST["telefono"]) && isset($_POST["saldo"])  && isset($_POST["password"])){
					$nombre=$_POST["nombre"];
					$dir=$_POST["direccion"];
					$telf= $_POST["telefono"];
					$saldo = $_POST["saldo"];
					$usuario = $_SESSION["usuario"];
					$passwd = $_POST["password"];
					$base=mysqli_connect("127.0.0.1","root","","hotelspa");
					$resul=mysqli_query($base,"SELECT usuario FROM usuarios");
					while ($reg = mysqli_fetch_assoc($resul)) {
						if (empty($saldo)){
							$saldo = 200;
						}
					}
					
					mysqli_query($base,"UPDATE usuarios SET nombre='$nombre', direccion='$dir', telefono='$telf', saldo=$saldo, password='$passwd' WHERE usuario='$usuario' ");
					header("Location: modificar-tabla.php");
				}
			}
		?>
		<!-- Java Script -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	</body>
</html>
