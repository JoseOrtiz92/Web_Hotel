<?php session_start();?>
<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width" />
      <title>Hotel Spa & Resorts Ryu</title>
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css">
      <!-- CUSTOM STYLE -->  
      <link rel="stylesheet" href="css/template-style.css">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>    
      <script type="text/javascript" src="js/modernizr.js"></script>
      <script type="text/javascript" src="js/responsee.js"></script>   
   </head>
   <body class="size-1140">
      <!-- TOP NAV WITH LOGO -->  
      <header>
         <nav>
            <div class="line">
               <div class="top-nav">              
                  <div class="logo hide-l">
                     <a>HOTEL<br/><strong>MARQUESADO</strong></a>
                  </div>                  
                  <div class="top-nav s-12 l-5">
                     <ul class="right top-ul chevron">
                     	<?php
                     		if(!empty($_SESSION["usuario"])){
                        		echo '<li><a href="admin/CierreSesion.php">Cerrar Sesion</a></li>';
                        	}
                        	?>
                     	<li><a>
                     	<?php
                     		if(!empty($_SESSION["usuario"])){
                     			echo $_SESSION["usuario"];
                     		}
                     	?></a>
                        </li>
                           <?php 
                              if (!isset($_SESSION["usuario"])){
                                 echo '<li><a href="admin/login.php">Login</a>
                                    </li>';
                              }
                           ?>
                        <?php
                           if(!empty($_SESSION["usuario"])){
                              echo "<li><a href='reserva.php'>Reservar</a>";
                              echo "</li>";
                           }
                        ?>
                        <?php
                           if(!empty($_SESSION["usuario"])){
                              echo "<li><a href='misReservas.php'>Mis Reservas</a>";
                              echo "</li>";
                           }
                        ?>
                     </ul>
                  </div>
                  <ul class="s-12 l-2">
                     <li class="logo hide-s hide-m">
                        <a href="">HOTEL<br/><strong>RYU</strong></a>
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <section>
         <!-- CAROUSEL -->  	
         <div id="carousel">
            <div id="owl-demo" class="owl-carousel owl-theme">
               <div class="item">
                  <img src="img/first.jpg" alt="">      
                  <div class="carousel-text">
                     <div class="line">
                        <div class="s-12 l-9">
                           <h2>Piscina exterior</h2>
                        </div>
                        <div class="s-12 l-9">
                           <p>Terraza y servicio a pie de piscina 
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <img src="img/second.jpg" alt="">      
                  <div class="carousel-text">
                     <div class="line">
                        <div class="s-12 l-9">
                           <h2>Jacuzzi y sala de relajación</h2>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <img src="img/third.jpg" alt="">      
                  <div class="carousel-text">
                     <div class="line">
                        <div class="s-12 l-9">
                           <h2>Habitaciones totalmente equipadas</h2>
                        </div>
                        <div class="s-12 l-9">
                           <p>Diseño moderno de última tendencia
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="jose">
         </div>
         <!-- SECOND BLOCK --> 	
         <div id="second-block">
            <div class="line">
               <div class="margin-bottom">
                  <div class="margin">
                     <article class="s-12 l-8 center">
                        <h1>Descansa y Relajate</h1>
                        <p class="margin-bottom">Complejo hotelero de 5 estrellas, con circuito termal de hidromasaje y masajes. Disfruta de una estancia relajante con nuestras
                        	actividades, y nuestras habitaciones totalmente equipadas, con aire acondicionado, televisión, caja fuerte y albornoces.
                        </p> 			
                     </article>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- FOOTER -->   
      <footer>
         <div class="line">
            <div class="s-12 l-6">
               <p>Copyright 2015
               </p>
            </div>
            <div id="contacto" class="s-12 l-6">
               <p class="right">
                  Carretera del marquesado, sn <br>
                  Telefono de contacto: 956585756
               </p>
            </div>
         </div>
      </footer>
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>   
      <script type="text/javascript">
         jQuery(document).ready(function($) {  
           $("#owl-demo").owlCarousel({
         	slideSpeed : 300,
         	autoPlay : true,
         	navigation : false,
         	pagination : false,
         	singleItem:true
           });
           $("#owl-demo2").owlCarousel({
         	slideSpeed : 300,
         	autoPlay : true,
         	navigation : false,
         	pagination : true,
         	singleItem:true
           });
         });	 
      </script> 
   </body>
</html>