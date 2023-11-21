
<?php 

	require_once "../conexion.php";
	$conexion=conexionmysql();
	$id=$_POST['id'];
	//echo "prueba";
	$sql="update cc_usuarios set estado=0 where id_usuario='$id'";
	echo $result=mysqli_query($conexion,$sql);
	session_start();

  
 ?>