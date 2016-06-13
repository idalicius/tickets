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

			$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";

			//echo var_dump(isset($codigo));

			if(isset($codigo) & $codigo != "")
			{
					//error_reporting(0);

					require_once("./default_config.php");

					$codigo = $_REQUEST["codigo"];

					$idc = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"tickets") or die("I can`t connect to MySQL Server");
					//mysql_select_db($mysql_db,$idc);

					########este codigo valida la primera vez que se entra
					$sql = "select id, codigo, precio, tipo, vendido, timestamp from codigo where codigo like'".$codigo."' limit 1";
					$resultset = mysqli_query($idc, $sql) or die(mysqli_error($idc));
					
					$datos = mysqli_fetch_assoc($resultset); 
					
					$total = mysqli_num_rows($resultset);
					if($total == 1)
					{
						
						
						if($datos['vendido'] == 0)
						{	
							 {
									$msg = "Boleto N°: <b><font color='green'>".$datos['codigo']."</font></b>";
									$img = "./images/go.png";
									$id = $datos['id'];
									$sql = "UPDATE codigo set vendido = 1, timestamp = '".date("Y-m-d H:i:s")."' where id = ".$id;
									$resultset = mysqli_query($idc, $sql) or die(mysqli_error($idc));
							 }
						}
						else
						{
							$msg = "Boleto N°: <b><font color='red'>".$datos['codigo']."</font></b> vendido el ".$datos['timestamp'];
							$img = "./images/stop.png";
						}
						mysqli_close($idc);
					}
					if($total==0)
					{
					 $msg = "<b><font color='red'>Error: codigo ".$datos['codigo']." no existente.</font></b>";
					 $img = "./images/stop.png";
					}
					######Fin primera vez que se entra
			}
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
                        <h3>Bienvenidos</h3>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 col-sm-2"></div>
                     <div class="col-md-6 col-sm-8">
                        <div class="form">
                           <form method="POST" id="contactform" class="contact-form text-center" role="form" action="./" >
                              <h6 class="<?php echo $clase; ?>">
                                 <span class="olored-text icon_check"><?php echo $msg; ?></span>
								<p><img src="<?php echo $img; ?>"></p>					 

                              </h6>

                              <input id="cf-name" type="text" placeholder="CODIGO" name="codigo" autofocus>
                              <input id="submit" class="button red" type="submit" data-style="expand-left" name="submit" value="Aceptar">
                           </form>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-2"></div>
                  </div>
                  <div class="row text-center">
                     <div class="col-md-12">
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
                     Power by SINETIC Soluciones <a href="./estadisticas.php">Estadisticas</a>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>