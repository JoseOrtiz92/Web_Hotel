<!DOCTYPE html>
<html lang="es">
<?php
ob_start();
?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Eliminar usuario</title>
		<!-- Bootstrap core CSS-->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom fonts for this template-->
		<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Page level plugin CSS-->
		<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
		<!-- Custom styles for this template-->
		<link href="css/sb-admin.css" rel="stylesheet">
	</head>
	<body class="fixed-nav sticky-footer bg-dark" id="page-top">
		<!--Menu de navegacion -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
			<a class="navbar-brand" href="delete-reservas.php">Administrador</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
					<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
						<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
							<i class="fa fa-fw fa-wrench"></i>
							<span class="nav-link-text">Usuarios</span>
						</a>
						<ul class="sidenav-second-level collapse" id="collapseComponents">
							<li>
								<a href="crearUser.php">Crear</a>
							</li>
							<li>
								<a href="modificar-tabla.php">Modificar</a>
							</li>
							<li>
								<a href="eliminar-usuarios.php">Eliminar</a>
							</li>
						</ul>
					</li>
					<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
						<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
							<i class="fa fa-fw fa-file"></i>
							<span class="nav-link-text">Servicios</span>
						</a>
						<ul class="sidenav-second-level collapse" id="collapseExamplePages">
							<li>
								<a href="delete-reservas.php">Reservas</a>
							</li>
							<li>
								<a href="mod-habitaciones.php">Habitaciones</a>
							</li>
							<li>
								<a href="mod-servicios.php">Tipos de servicio</a>
							</li>
						</ul>
					</li>
				</ul>
				<ul class="navbar-nav sidenav-toggler">
					<li class="nav-item">
						<a class="nav-link text-center" id="sidenavToggler">
							<i class="fa fa-fw fa-angle-left"></i>
						</a>
					</li>
				</ul>
				<!-- Login -->
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-fw fa-sign-out"></i>Cerrar Sesión</a>
					</li>
				</ul>
			</div>
		</nav>


		<div class="content-wrapper">
			<div class="container-fluid">

				<!-- Example DataTables Card-->
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Eliminar Usuarios</div>
					<div class="card-body">
						<div class="table-responsive">
							<form method="POST" action="" onsubmit="return confirm('¿Estas seguro de eliminar al usuario seleccionado?')">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Direccion</th>
											<th>Teléfono</th>
											<th>Saldo</th>
											<th>Usuario</th>
											<th>Contraseña</th>
											<th></th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Nombre</th>
											<th>Dirección</th>
											<th>Teléfono</th>
											<th>Saldo</th>
											<th>Usuario</th>
											<th>Contraseña</th>
											<th></th>
										</tr>
									</tfoot>
									<tbody>
										<!-- Mostrar usuarios en la tabla -->
										<?php
											$base=mysqli_connect("127.0.0.1","root","","hotelspa");
											$resul=mysqli_query($base,"SELECT * FROM usuarios");
											while($reg = mysqli_fetch_assoc($resul)){
												if (strtolower($reg["usuario"]) != "admin"){
													echo '<tr>
															<td>'.$reg["nombre"].'</td>
															<td>'.$reg["direccion"].'</td>
															<td>'.$reg["telefono"].'</td>
															<td>'.$reg["saldo"].'</td>
															<td>'.$reg["usuario"].'</td>
															<td>'.$reg["password"].'</td>
															<td>
															<button class="eliminar" type="submit" name="'.$reg["usuario"].'"><img src="img/borrar.png" width="30" height="30"></button>
															</td>
															</tr>';
												}
											}
										?>
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<!--Eliminar el usuario indicado despues de las comprobaciones correspondientes -->
			<?php
				$base=mysqli_connect("127.0.0.1","root","","hotelspa");
				$resul=mysqli_query($base,"SELECT * FROM usuarios");
				while ($reg = mysqli_fetch_assoc($resul)){
					$i= $reg["usuario"];
					if (isset($_POST[$i])){ 
						if (comprobarReservas($i) == true){
							echo "<script language='javascript'> alert('El usuario ya ha realizado reservas no se puede eliminar') </script>";
							break;
						}
						else{
							mysqli_query($base,"DELETE FROM usuarios WHERE usuario='$i'");
							header("Location: index.html");
							header("Location: eliminar-usuarios.php");
						}
						
						
					}
				}

				function comprobarReservas($usuario){
					$base=mysqli_connect("127.0.0.1","root","","hotelspa");
					$resul2 = mysqli_query($base,"SELECT * FROM reservas"); 
					while ($reg2= mysqli_fetch_assoc($resul2)){
						if ($usuario == $reg2["usuario"]){
							return true;
						}
					}
					return false;
				}
			?>


			<!-- FOOTER -->
			<footer class="sticky-footer">
				<div class="container">
					<div class="text-center">
						<small>Copyright © Your Website 2017</small>
					</div>
				</div>
			</footer>

			<!-- Boton que lleva a la parte superior de la pagina-->
			<a class="scroll-to-top rounded" href="#page-top">
				<i class="fa fa-angle-up"></i>
			</a>
	
			<!-- Pregunta del logout -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">¿Estas seguro que quieres cerrar la sesión?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Selecciona cerrar para confirmar</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<a class="btn btn-primary" href="login.php">Cerrar Sesión</a>
					</div>
					</div>
				</div>
			</div>
	
			<!-- Bootstrap core JavaScript-->
			<script src="vendor/jquery/jquery.min.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
			<!-- Core plugin JavaScript-->
			<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
			<!-- Page level plugin JavaScript-->
			<script src="vendor/datatables/jquery.dataTables.js"></script>
			<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
			<!-- Custom scripts for all pages-->
			<script src="js/sb-admin.min.js"></script>
			<!-- Custom scripts for this page-->
			<script src="js/sb-admin-datatables.min.js"></script>	
		</div>
	</body>
<?php
ob_end_flush();
?>
</html>
