<?php 
	ob_start();
	session_start();
	$total=0;
	$conn=mysqli_connect("127.0.0.1", "root", "", "hotelspa");
	if($conn==false){
		echo "<script language='javascript'>alert('Error al conectarse a la base de datos')</script>";
	}else{
		$habitaciones=mysqli_query($conn, "SELECT tipo, precio FROM habitacion GROUP BY tipo");
		$actividades=mysqli_query($conn, "SELECT id, nombre, precio FROM actividades");
		$pensiones=mysqli_query($conn, "SELECT tipo, precio FROM tipo_pension");
	}
		
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<title>Hotel RYU</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="reserva.css" type="text/css" />
	<script language="javascript">
		var total=0;
		var totalHab=0;
		var totalPen=0;
		var finicio;
		var ffin;
		var precio;

		function sumarHab(){
			var preciohab=document.getElementById("hab").value;
			if(preciohab==""){
				preciohab=0;
				totalHab=0;
				vaciarFecha();
			}else{
				vaciarFecha();
				totalHab=parseInt(preciohab);
			}
			actTotal();
		}

		function sumarPen(){
			var preciopen=document.getElementById("pen").value;
			if(preciopen==""){
				preciopen=0;
				totalPen=0;
				vaciarFecha();
			}else{
				vaciarFecha();
				totalPen=parseInt(preciopen);
			}
			actTotal();
		}

		function vaciarFecha(){
			if(fechaEn!=""){
				document.getElementById("fechaEn").value="";
			}
			if(fechaSal!=""){
				document.getElementById("fechaSal").value="";
			}
		}

		function comprobarCheck(id){
			if(total==""){
				total=0;
			}
			if(document.getElementById(id).checked==true){
				total+=parseInt(document.getElementById(id).value);
				vaciarFecha();
			}else{
				total-=parseInt(document.getElementById(id).value);
				vaciarFecha();
			}
			actTotal();
		}

		function actTotal(){
			document.getElementById("precio").value=total+totalHab+totalPen;
		}

		function precioFechas(){
			var precio=totalHab+totalPen+total;
			var difFecha=(ffin-finicio)/86400000;
			if(isNaN(difFecha)==false){
				document.getElementById("precio").value=precio*difFecha;
			}
		}

		function validarFecha(){
			var fechaEn=document.getElementById("fechaEn").value;
			var fechaSal=document.getElementById("fechaSal").value;
			finicio=new Date(fechaEn);
			ffin=new Date(fechaSal);
			
			if(finicio>ffin){
				alert("Error, la fecha de entrada es mayor a la fecha de Salida");
				document.getElementById("fechaEn").value="";
				document.getElementById("fechaSal").value="";
			}else{
				if(finicio.getDate()==ffin.getDate() && finicio.getMonth()==ffin.getMonth() && finicio.getFullYear()==ffin.getFullYear()){
					actTotal();
				}else{
					precioFechas();
				}
			}
			
		}
	</script>
</head>
<body>
	<?php 
		$consSaldo="SELECT saldo FROM usuarios WHERE usuario='".$_SESSION["usuario"]."'";
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
				<li><a href="misReservas.php">Mis Reservas</a></li>
				<li class="active"><a href="admin/CierreSesion.php">Cerrar sesion</a></li>
			</ul>
		</div>
	</nav>
		<div class="main" id="main">
		<div class="w3layouts_main_grid">
		<div class="booking-form-head-agile">
		<h3>Formulario de reserva</h3>
		</div>
			<form action="" method="POST" onsubmit="return confirm('¿Confirmar la reserva?')">
				<div class="w3_agileits_main_grid w3l_main_grid">
					<div class="agileits_grid">
						<h5>Nombre: * </h5>
						<div class="nam">
							<input type="text" name="nombre" placeholder="Nombre" required>
						</div>
						<div class="nam1">
							<input type="text" name="apellidos" placeholder="Apellidos" required>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="w3_agileits_main_grid w3l_main_grid">
					<div class="agileits_grid">
						<h5>E-mail </h5>
							<input type="email" name="email" placeholder="miEmail@gmail.com" required>
					</div>
				</div>
				<div class="agileits_main_grid w3_agileits_main_grid">
					<div class="styled-select">
						<div class="hab">
							<h5>Tipo de habitación</h5>
							<select id="hab" name="hab" onchange="sumarHab()" required>
								<option value=""></option>
								<?php
									while($row=mysqli_fetch_array($habitaciones)){
										echo "<option value=".$row['precio'].">".$row['tipo'];
										echo "</option>";
									}
								?>
							</select>
						</div>
						<div class="pen">
							<h5>Tipo de pensión</h5>
							<select id="pen" name="pen" onchange="sumarPen()">
								<option value=""></option>
								<?php
									while($row=mysqli_fetch_array($pensiones)){
										echo "<option value=".$row['precio'].">".$row['tipo'];
										echo "</option>";
									}
								?>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="agileits_main_grid w3_agileits_main_grid">
					<div class="servicio">
						<h5>¿Algún servicio?</h5>
							<div class="ch">
								<?php 
								$cont=0;
									while($row=mysqli_fetch_array($actividades)){
										$cont+=1;
										echo "<input id=".$row['nombre']." name=".$row['nombre']." type='checkbox' onclick='comprobarCheck(this.id)' value=".$row['precio']."><label for=".$cont.">".$row['nombre']."</label>";
									}
								?>
							</div>
					</div>
				</div>
				<div class="agileits_w3layouts_main_grid w3ls_main_grid">
					<div class="agileinfo_grid">
						<h5>Check In *</h5>
						
						<div class="agileits_w3layouts_main_gridl">
							<?php echo "<input id='fechaEn' class='date' name='fechaEn' type='date' min=".date('Y-m-d')." onchange='validarFecha()' required>";
							?>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="agileits_w3layouts_main_grid w3ls_main_grid">
					<div class="agileinfo_grid">
						<h5>Check Out *</h5>
						
						<div class="agileits_w3layouts_main_gridl">
							<?php echo "<input id='fechaSal' class='date' name='fechaSal' type='date' min=".date('Y-m-d')." onchange='validarFecha()' required>";
							?>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="w3_main_grid">
					<div class="text-center precio">
						<input class="input-sm text-center" type="text" readonly name="precio" id="precio"></p>
					</div>
					
					<div class="w3_main_grid_right text-center">
						<input type="submit" value="¡Reserva YA!" name="btnReserva" class="btn btn-primary">
					</div>
					<div class="clearfix"> </div>
				</div>
				
		</div>
	</div>
</form>
				<?php
					if(isset($_POST["btnReserva"])){
						/*COGER EL ID DEL TIPO DE PENSION Y TIPO DE HABITACION*/
						$pension=$_POST['pen'];
						$consIdPen=mysqli_query($conn, "SELECT id FROM tipo_pension WHERE precio=$pension");
						$Pens=mysqli_fetch_assoc($consIdPen);
						$idPension=$Pens['id'];

						$habit=$_POST['hab'];
						$consIdHab=mysqli_query($conn, "SELECT id FROM habitacion WHERE precio=$habit");
						$Habs=mysqli_fetch_assoc($consIdHab);
						$idHabitacion=$Habs['id'];

						/*COGER LA FECHA DE ENTRADA Y SALIDA DEL FORMULARIO*/
						$fechEnt=$_POST['fechaEn'];
						$fechSal=$_POST['fechaSal'];
						//COGER EL USUARIO
						$user=$_SESSION['usuario'];
						/*COGER EL ID DE LA RESERVA*/
						$consMaxId=mysqli_query($conn, "SELECT MAX(id) FROM reservas");
						$maxCons=mysqli_fetch_assoc($consMaxId);
						$idReservas=$maxCons['MAX(id)']+1;
						/*PRECIO TOTAL DE LA RESERVA*/
						$totalReserva=$_POST['precio'];

						if($_POST['precio']>$ref['saldo']){
							echo "<script language='javascript'>alert('No tienes suficiente saldo en la tarjeta')</script>";
						}else{
							/*SACAR EL ID DE LAS HABITACIONES RESERVADAS PARA LA FECHA ELEGIDA POR EL CLIENTE*/
							$consIdHabRes="SELECT id_habitacion FROM reservas WHERE (fecha_entrada>'$fechEnt' AND fecha_entrada<'$fechSal') OR (fecha_salida>'$fechEnt' AND fecha_salida<'$fechSal') OR (fecha_entrada<='$fechEnt' AND fecha_salida>='$fechSal') OR(fecha_entrada>'$fechEnt' AND fecha_salida<'$fechSal')";
							$idHabRes=mysqli_query($conn, $consIdHabRes);
							
							if(mysqli_num_rows($idHabRes)>0){
								$cont2=0;
								$comparador=0;
								$idHab=mysqli_query($conn, "SELECT id FROM habitacion WHERE precio=$habit");
								$numHab=mysqli_num_rows($idHab);
								while($row=mysqli_fetch_assoc($idHab)){
									$comparador+=1;
									$idHabRes=mysqli_query($conn, $consIdHabRes);
									while($fil=mysqli_fetch_assoc($idHabRes)){
										if($row['id']==$fil['id_habitacion']){
											$cont2+=1;
										}
									}
									if($cont2==0){
										/*Se reserva*/
										if(mysqli_query($conn,"INSERT INTO reservas VALUES ($idReservas, '$user', ".$row['id'].", '$fechEnt' , '$fechSal', $idPension, $totalReserva)")){
											/*COGER ID DE ACTIVIDADES QUE ESTEN MARCADAS Y LAS RESERVO*/
											$actividades=mysqli_query($conn, "SELECT id, nombre FROM actividades");
											while($act=mysqli_fetch_array($actividades)){
												$nombreAct=$act['nombre'];
												if(isset($_POST[$nombreAct])){
													$idAct=$act['id'];
													mysqli_query($conn, "INSERT INTO reservaactividad VALUES ($idReservas, $idAct)");
												}
											}
											mysqli_query($conn, "UPDATE usuarios SET saldo=$s-$totalReserva WHERE usuario='".$_SESSION['usuario']."'");
											echo "<script language='javascript'>alert('Su reserva se ha realizado con exito')</script>";
											header("Location: misReservas.php");
											break;
										}
									}else{
										if($comparador==$numHab){
											echo "<script language='javascript'>alert('Todas las habitaciones estan reservadas para esa fecha')</script>";
										}
									}
									$cont2=0;
								}
							}else{
								if(mysqli_query($conn,"INSERT INTO reservas VALUES ($idReservas, '$user', $idHabitacion, '$fechEnt' , '$fechSal', $idPension, $totalReserva)")){
									/*COGER ID DE ACTIVIDADES QUE ESTEN MARCADAS Y LAS RESERVO*/
									$actividades=mysqli_query($conn, "SELECT id, nombre FROM actividades");
									while($act=mysqli_fetch_array($actividades)){
										$nombreAct=$act['nombre'];
										if(isset($_POST[$nombreAct])){
											$idAct=$act['id'];
											mysqli_query($conn, "INSERT INTO reservaactividad VALUES ($idReservas, $idAct)");
										}
									}
									mysqli_query($conn, "UPDATE usuarios SET saldo=$s-$totalReserva WHERE usuario='".$_SESSION['usuario']."'");
									echo "<script language='javascript'>alert('Su reserva se ha realizado con exito')</script>";
									header("Location: misReservas.php");
								}
							}
						}						
					}
				?>
</body>
<?php  
	ob_end_flush();
?>
</html>
