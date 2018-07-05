<?php 
	session_start();
	$conn=mysqli_connect("127.0.0.1", "root", "", "hotelspa");
	if($conn==false){
		echo "<script language='javascript'>alert('Error al conectarse a la base de datos')</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mis Reservas</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="misReservas.css" type="text/css" />
</head>
<body>
	<?php 
		$consSaldo="SELECT saldo FROM usuarios WHERE usuario='".$_SESSION["usuario"]."'";
		$consMisreservas="SELECT r.id, r.usuario, h.tipo hab, r.fecha_entrada, r.fecha_salida, p.tipo, r.total_reserva FROM reservas r, habitacion h, tipo_pension p WHERE r.usuario='".$_SESSION['usuario']."' AND r.id_habitacion=h.id AND r.id_pension=p.id";
		$misReservas=mysqli_query($conn, $consMisreservas);
		$saldo=mysqli_query($conn, $consSaldo);
		$ref=mysqli_fetch_assoc($saldo);
		$s=$ref["saldo"];
	?>
	<nav class="navbar navbar-inverse  navbar-right">
		<div class="container-fluid">
			<ul class="nav navbar-nav white">
				<li><a><?php echo $_SESSION["usuario"];?></a></li>
				<li><a><?php
							echo $s;
						 ?>
				€</a></li>
				<li><a href="reserva.php">Reservar</a></li>
				<li class="active"><a href="admin/CierreSesion.php">Cerrar sesion</a></li>
			</ul>
		</div>
	</nav>

	<div class="container cont">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form method="POST" action="" onsubmit="return confirm('¿Estas seguro de eliminar esta reserva? Perderias el 25% del total')">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Usuario</th>
									<th>Tipo de Habitacion</th>
									<th>Tipo de pension</th>
									<th>Fecha de Entrada</th>
									<th>Fecha de Salida</th>
									<th>Total</th>
									<th>Eliminar Reserva</th>
								</tr>
							</thead>
							<?php 
								while($row=mysqli_fetch_assoc($misReservas)){
									echo "<thead>";
										echo "<tr>";
											echo "<td>".$row['usuario']."</td>";
											echo "<td>".$row['hab']."</td>";
											echo "<td>".$row['tipo']."</td>";
											echo "<td>".$row['fecha_entrada']."</td>";
											echo "<td>".$row['fecha_salida']."</td>";
											echo "<td>".$row['total_reserva']." €</td>";
											echo "<td>";
											echo "<button class='eliminar' type='submit' name='".$row['id']."''><img src='elim2.png' width='20' height='20'>";
											echo "</button>";
											echo "</td>";
										echo "</tr>";
									echo "</thead>";
								}
							?>
						</table>
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
	</div>
		<?php
			$cont=0;
			$base=mysqli_connect("127.0.0.1","root","","hotelspa");
			$resul=mysqli_query($base,"SELECT * FROM reservas WHERE usuario='".$_SESSION['usuario']."'");
			$fechaHoy = date("Y-m-d");
			while ($reg = mysqli_fetch_assoc($resul)){
				$i= $reg["id"];
				if (isset($_POST[$i])){
					if ($fechaHoy < $reg["fecha_entrada"]){
						$dev=$reg['total_reserva']*0.75;
						mysqli_query($base,"UPDATE usuarios SET saldo=(saldo+$dev) WHERE usuario='".$_SESSION['usuario']."'");
						mysqli_query($base,"DELETE FROM reservaactividad WHERE id_reserva=$i");
						mysqli_query($base,"DELETE FROM reservas WHERE id=$i");
						echo '<script language="javascript">
									var total="'.$dev.'";
	                   				 alert("Se le ha devuelto al usuario "+total+"€"); location.href="misReservas.php";</script> ';
					}
					else{
						$cont=1;
						break;
					}
				}
			}
			if ($cont==1){
				echo "<script language='javascript'> alert('No se puede cancelar una reserva ya iniciada') </script>";
			}
		?>
</body>
</html>