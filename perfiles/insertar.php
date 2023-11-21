<?php 

	require_once "../conexion.php";
	$conexion=conexionmysql();
	$n=$_POST['nombre'];
	$c=$_POST['carnet'];
	$u=$_POST['usuario'];
	$ps=$_POST['password'];
	$pe=$_POST['perfil'];
	$ps = md5($ps); 
	$f="2023-01-01";

	$sql="INSERT into cc_usuarios (nombre,carnet,usuario,password,perfil,fecha_r,estado)
	values ('$n','$c','$u','$ps',$pe,'$f',1)";
	echo $result=mysqli_query($conexion,$sql);

 ?>