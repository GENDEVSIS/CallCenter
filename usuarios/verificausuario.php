
<?php
include('../conexion.php');
$con=conexionmysql();
$usuario    = $_REQUEST['usuario'];

//Verificando si existe algun cliente en bd ya con dicha usuario asignada
//Preparamos un arreglo que es el que contendrá toda la información
$jsonData = array();
$selectQuery   = ("SELECT usuario FROM cc_usuarios WHERE usuario='".$usuario."' ");
$query         = mysqli_query($con, $selectQuery);
$totalCliente  = mysqli_num_rows($query);

  //Validamos que la consulta haya retornado información
  if( $totalCliente <= 0 ){
    $jsonData['success'] = 0;
   // $jsonData['message'] = 'No existe Cédula ' .$usuario;
    $jsonData['message'] = '';
} else{
    //Si hay datos entonces retornas algo
    $jsonData['success'] = 1;
    $jsonData['message'] = '<p style="color:red;">Ya existe el Usuario <strong>(' .$usuario.')<strong></p>';
  }

//Mostrando mi respuesta en formato Json
header('Content-type: application/json; charset=utf-8');
echo json_encode( $jsonData );
?>