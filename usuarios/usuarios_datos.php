<?php
	session_start();
	require_once "conexion.php";
	$conexion=conexionmysql();  
  $conexionix=conexion();

    $hoy = date("Y-m-d");
    
    if(isset($_GET['app'])){
      $app="&app=1";
  }else{
      $app="";
  }
    
  $sql="";
  $consulta="   select  id_usuario,nombre,carnet,usuario,perfil,
                        case when perfil=1 then 'ADMINISTRADOR'  when perfil=2 then 'SUPERVISOR'  when perfil=3 then 'AGENTE' end
                from    cc_usuarios where estado=1";
 // echo $consulta;
  $result=mysqli_query($conexion,$consulta);

  $consultaperfil="   select  id_perfil,nombre
                from    cc_perfiles where estado=1";
 // echo $consulta;
  $resultperfil=mysqli_query($conexion,$consultaperfil);
  $resultperfil_u=mysqli_query($conexion,$consultaperfil);
?>