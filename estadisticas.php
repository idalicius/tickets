<!DOCTYPE html>

<html class="js" lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="Sistema de Entradas" name="description">
      <meta content="SINETIC Soluciones" name="author">
	  <meta http-equiv="Cache-Control" content="public" />	  
      <title>Sistema de Entradas</title>
      <link href="assets/css/bootstrap.css" rel="stylesheet">
      <link href="lib/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="lib/owl.carousel/owl-carousel/owl.carousel.css" rel="stylesheet">
      <link href="lib/owl.carousel/owl-carousel/owl.theme.css" rel="stylesheet">
      <link rel="stylesheet" href="css/font.css">
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/color.css">
   </head>
   <body>
			<?php

			$msg = "";
			$clase = "success";
			$img = "";



			require_once("./default_config.php");

			$idc = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"tickets") or die("I can`t connect to MySQL Server");


			$sql = "SELECT  `precio`, COUNT(`id`) as vendidos, SUM(`precio`) AS total, evento FROM `codigo` WHERE `vendido` = 1 and `evento` <> '' GROUP BY `evento`;";
			$resultset = mysqli_query($idc, $sql) or die(mysqli_error($idc));
			
			while($datos = mysqli_fetch_assoc($resultset))
			{

					if($datos['vendidos'] == 0)
					{	
						$msg = "Boletos Vendidos: <b><font color='green'>".$datos['vendidos']."</font></b>";
					}
					else
					{
						$msg = $msg."Vendidos: <b><font color='red'>".$datos['vendidos']."</font></b> Costo: <b><font color='red'>$".$datos['precio']."</font></b> Total: <b><font color='red'>$".$datos['total']."</font></b> Evento: <b><font color='green'>".$datos['evento']."</font></b><br>";
					}
			}
			mysqli_close($idc);
			######Fin primera vez que se entra

			?>   
      <div class="testimonial-area">
         <div class="testimonial-innr parallax" style="background-position: 50% 0px;"> </div>
      </div>
      <div id="form-area" class="form-area">
      <div class="container">
         <div class="form-area-box-outer">
            <div class="form-area-box">
               <div class="section-head">
                  <div class="row text-center">
                     <div class="col-md-3"></div>
                     <div class="col-md-6">
                        <h3>Estadisticas de Venta</h3>
                     </div>
                  </div>
                  <div class="row">
				  <div class="row text-center">
                     <h6 class="<?php echo $clase; ?>"><?php echo $msg; ?></h6>
				  </div>
                  </div>
                  <div class="row text-center">
					 
                  <div class="row">
                     <div class="col-md-3 col-sm-2"></div>
                     <div class="col-md-6 col-sm-8">
                        <div class="form">
                           <form method="POST" id="contactform" class="contact-form text-center" role="form" action="./" >
                              <input id="submit" class="button red" type="submit" data-style="expand-left" name="submit" value="Volver a venta">
                           </form>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-2"></div>
                  </div>
				     <div class="col-md-12"><br><br>
                        <p>
						<img src="./images/descarga.png">
						</p>
                     </div>
					 
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="footer-bar">
         <div class="container">
            <div class="row text-center">
               <div class="col-md-12">
                  <p>
                     Power by SINETIC Soluciones <a href="">Estadisticas</a>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>