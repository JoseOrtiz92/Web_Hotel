<!DOCTYPE html>
<?php
ob_start();
?>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Administración</title>
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
			<div class="container-fluid"><br>
				<form action="" method="POST">
					<div class="row">
						<div class="col-xl-4 col-sm-6 mb-4">
							<h2>Habitacion Simple</h2>
							<p>Modifica el precio de la habitacion</p>
							<div class="card" style="width:400px">
								<img class="card-img-top" src="img/individual.jpg" alt="Card image" style="width:100%">
								<div class="card-body">
									<?php 
										$base=mysqli_connect("127.0.0.1","root","","hotelspa");
										$resul=mysqli_query($base,"SELECT * FROM habitacion WHERE tipo='Simple'");
										while($reg = mysqli_fetch_assoc($resul)){
											echo '<h4 class="card-title">'.$reg["precio"].'€</h4>
													<input type="text" name="'.$reg["tipo"] .'" placeholder="Nuevo precio" pattern="[0-9]{0,8}" minlength="0" maxlength="8">
													<button class="eliminar" name="'.$reg["id"] .'"> <img src="img/modificar.png" width="30" height="30"></button> ';
										}
									?>
								</div>
							</div>
					    </div>

						<div class="col-xl-4 col-sm-6 mb-4">
							<h2>Habitacion Doble</h2>
							<p>Modifica el precio de la habitacion</p>
							<div class="card" style="width:400px">
								<img class="card-img-top" src="img/doble.jpg" alt="Card image" style="width:100%">
								<div class="card-body">
									<?php 
										$base=mysqli_connect("127.0.0.1","root","","hotelspa");
										$resul=mysqli_query($base,"SELECT * FROM habitacion WHERE tipo='Doble'");
										while($reg = mysqli_fetch_assoc($resul)){
											echo '<h4 class="card-title">'.$reg["precio"].'€</h4>
													<input type="text" name="'.$reg["tipo"] .'" placeholder="Nuevo precio" pattern="[0-9]{0,8}" minlength="0" maxlength="8">
													<button class="eliminar" name="'.$reg["id"] .'"> <img src="img/modificar.png" width="30" height="30"></button> ';
										}
									?>
								</div>
							</div>
					    </div>
					    <div class="col-xl-4 col-sm-6 mb-4">
							<h2>Suite</h2>
							<p>Modifica el precio de la habitacion</p>
							<div class="card" style="width:400px">
								<img class="card-img-top" src="img/Suite.jpg" alt="Card image" style="width:100%">
								<div class="card-body">
									<?php 
										$base=mysqli_connect("127.0.0.1","root","","hotelspa");
										$resul=mysqli_query($base,"SELECT * FROM habitacion WHERE tipo='Suite'");
										while($reg = mysqli_fetch_assoc($resul)){
											echo '<h4 class="card-title">'.$reg["precio"].'€</h4>
													<input type="text" name="'.$reg["tipo"] .'" placeholder="Nuevo precio"  pattern="[0-9]{0,8}" minlength="0" maxlength="8">
													<button class="eliminar" name="'.$reg["id"] .'" > <img src="img/modificar.png" width="30" height="30"></button> ';
										}
									?>
								</div>
							</div>
					    </div>
					</div>
				</form>
			</div>
		</div>
			<?php
				$base=mysqli_connect("127.0.0.1","root","","hotelspa");
				$resul=mysqli_query($base,"SELECT * FROM habitacion");
				while($reg = mysqli_fetch_assoc($resul)){
					$id=$reg["id"];
					$tipo=$reg["tipo"];
					if(isset($_POST[$id])){
						if(!empty($_POST[$tipo])){
							$update=mysqli_query($base,"UPDATE habitacion SET precio=".$_POST[$tipo]." WHERE id=$id");
							header("Location: index.html");
							header("Location: mod-habitaciones.php");
						}
					}
				}
			?>
				<!-- /.container-fluid-->
				<footer class="sticky-footer">
					<div class="container">
						<div class="text-center">
							<small>Copyright © Your Website 2017</small>
						</div>
					</div>
				</footer>

				<!-- Scroll to Top Button-->
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
				<script src="vendor/chart.js/Chart.min.js"></script>
				<script src="vendor/datatables/jquery.dataTables.js"></script>
				<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
				<!-- Custom scripts for all pages-->
				<script src="js/sb-admin.min.js"></script>
				<!-- Custom scripts for this page-->
				<script src="js/sb-admin-datatables.min.js"></script>
				<script src="js/sb-admin-charts.min.js"></script>

			
		</div>
	</body>
<?php
ob_end_flush();
?>
</html>