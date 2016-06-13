<?php
//error_reporting(0);

//include_once("./index.php");
require_once("./default_config.php");

$codigo = $_REQUEST["codigo"];


$idc = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"tickets") or die("I can`t connect to MySQL Server");
//mysql_select_db($mysql_db,$idc);


########este codigo valida la primera vez que se entra
$sql = "select id, codigo, precio, tipo, vendido, timestamp from codigo where codigo like'".$codigo."' limit 1";
$resultset = mysqli_query($idc, $sql) or die(mysqli_error($idc));
$total = mysqli_num_rows($resultset);

if($total == 1)
{
	$datos = mysqli_fetch_assoc($resultset); 
	
	if($datos['vendido'] == 0)
	{	
		 {
				echo "<div class='text-center'><h5>Boleto N°: ".$datos['codigo']."</h5></div>";
				#echo "<div class='text-center'><img src='./img/sinetic.png'></img></div>";
				$id = $datos['id'];
				$sql = "UPDATE codigo set vendido = 1, timestamp = '".date("Y-m-d H:i:s")."' where id = ".$id;
				$resultset = mysqli_query($idc, $sql) or die(mysqli_error($idc));
		 }
	}
	else
	{
		echo "Este boleto ya fue vendido: ".$datos['timestamp'];
	}
	mysqli_close($idc);
}
if($total==0)
{
echo "<div class='text-center'><h6>Error: codigo no existente.</h6></div>";
}
######Fin primera vez que se entra
?>