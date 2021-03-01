<?php
	$Humedad = 		$_GET ['Hum'];
	$Temperatura =	$_GET ['Temp'];
	$valvula_1 = 	$_GET ['v1'];
	$valvula_2 = 	$_GET ['v2'];
	$h2ome = 			($_GET ['sf1']*20);
	$servicio = 		($_GET ['sf2']*20); 
	$empo = 			($_GET ['sf3']*20); 

	$nivel = 		$_GET ['SN'];
	
	$dia=date("d");
	$mes=date("m");
	$año=date("Y");

	//$hoy=$año."-".$mes."-".$dia;
	$hoy = date("Y-m-d H:i:s"); 

$conexion = mysqli_connect('localhost', 'root', '','h2ome');
mysqli_query($conexion, "SET NAMES 'utf8");


if (($empo==0) && ($h2ome!=0)){
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$h2ome', '$hoy', '67');" );
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$empo', '$hoy', '68');" );
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$h2ome', '$hoy', '69');" );
}else if (($h2ome==0) && ($empo!=0)) {
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$empo', '$hoy', '67');" );
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$empo', '$hoy', '68');" );
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$h2ome', '$hoy', '69');" );
} elseif (($h2ome==0) && ($empo==0)) {
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$h2ome', '$hoy', '67');" );
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$h2ome', '$hoy', '68');" );
	mysqli_query($conexion, "INSERT INTO `consumos`( `consumo`, `fechaConsumo`, `administracion_id`) VALUES ( '$h2ome', '$hoy', '69');" );
}
mysqli_query($conexion, "UPDATE `almacenamientos` SET nivel= '$nivel'  WHERE hogar_id=33" );

mysqli_close($conexion); 


/*
$conexion = mysqli_connect('localhost', 'root', '','proyecto_agua');//host,Usuario de MySql; Contraseña de MySql,Base de datos
mysqli_query($conexion, "SET NAMES 'utf8");

mysqli_query($conexion, "INSERT INTO `sensores` (`id`, `Humedad`, `Temperatura`, `valvula_1`, `valvula_2`, `SF1`, `SF2`, `SF3`, `SNivel`, `Fecha_Hora`) VALUES (NULL, '$Humedad', '$Temperatura', '$valvula_1', '$valvula_2', '$SF1', '$SF2', '$SF3', '$SNivel',  current_timestamp());" );
mysqli_close($conexion);
*/
/*
INSERT INTO `consumos` ( `consumo`, `fechaConsumo`, `created_at`, `updated_at`, `administracion_id`) VALUES
( 0.00, '2020-10-17', '2020-10-17 06:03:08', '2020-10-17 06:03:08', 72),
( 50, '2020-10-17', '2020-10-17 06:04:01', '2020-10-17 06:04:01', 71),
( 50, '2020-10-17', '2020-10-17 06:04:26', '2020-10-17 06:04:26', 70);


70=senor cocina
71=empo
72=H2ome

SELECT sum(consumo)
FROM consumos
WHERE administracion_id = 67
*/
?>
