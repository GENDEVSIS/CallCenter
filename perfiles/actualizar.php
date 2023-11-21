<?php 
require_once "../conexion.php";
$conexion=conexionmysql();

			$id=$_POST['id'];
            $nombre=$_POST['nombre'];
            $carnet=$_POST['carnet'];
			$usuario=$_POST['usuario'];
            $password=$_POST['password'];
			$password = md5($password); 
			$perfil=$_POST['perfil'];
            //echo  $completar.$usuario.$oficina;
            $sql="UPDATE cc_usuarios set 	nombre='$nombre',
											carnet='$carnet',
											usuario='$usuario',
											password='$password',
											perfil=$perfil
				    where id_usuario=$id";
            //echo $sql;
	        echo $result=mysqli_query($conexion,$sql);
           // header("Location:../usuarios.php");


	// require_once "conexion.php";
	// $conexion=conexionmysql();
	// $id=$_POST['id'];
	// //echo "prueba";
	// $sql="DELETE from act_activos where act_id='$id'";
	// echo $result=mysqli_query($conexion,$sql);
	// session_start();

 ?>