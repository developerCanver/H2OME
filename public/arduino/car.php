<?php
	$Humedad = 		$_GET ['Hum'];
	$Temperatura =	$_GET ['Temp'];
	$valvula_1 = 	$_GET ['v1'];
	$valvula_2 = 	$_GET ['v2'];
	$h2ome = 			$_GET ['sf1'];
	$servicio = 		$_GET ['sf2']; 
	$empo = 			$_GET ['sf3']; 
	$SNivel = 		$_GET ['SN']; 
$conexion = mysqli_connect('localhost', 'root', '','proyecto_agua');//host,Usuario de MySql; Contraseña de MySql,Base de datos
mysqli_query($conexion, "SET NAMES 'utf8");


	mysqli_query($conexion, "INSERT INTO `sensores` (`id`, `Humedad`, `Temperatura`, `valvula_1`, `valvula_2`, `SF1`, `SF2`, `SF3`, `SNivel`, `Fecha_Hora`) 
	VALUES
	 (NULL, '$Humedad', '$Temperatura', '$valvula_1', '$valvula_2', '$h2ome', '$servicio', '$empo', '$SNivel',  current_timestamp());" );

mysqli_close($conexion);


//require_once("ESTADOSARDU.php");

?>