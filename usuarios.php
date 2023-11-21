<?php 
    include "usuarios/usuarios_datos.php";
 ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title>CC Usuarios</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity=
            "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
            

  <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="librerias/alertifyjs/css/themes/default.css">

  <script type="text/javascript" src="librerias/bootstrap/js/jquery.min.js"></script>
  <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
  <script src="librerias/alertifyjs/alertify.js"></script>
  
  <script src="js/funciones.js"></script>
</head>
<body>

	<!-- Modal para registros nuevos -->
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
        	<label id="lbnombre">Nombre</label>
        	<input type="text" name="nombre" id="nombre" class="form-control input-sm">
        	<label id="lbcarnet">Carnet</label>
        	<input type="text" name="" id="carnet" class="form-control input-sm">
        	<label id="lbusuario">Usuario</label>
        	<input type="text" name="" id="usuario" class="form-control input-sm">
          <label id="lbcontraseña">Contraseña</label>
        	<input type="password" name="" id="contraseña" class="form-control input-sm">
          <label id="lbperfil">Perfil</label>
          <select class="form-control input-sm" id="perfil" name="perfil" required >
            <option value="0">Seleccionar</option>
            <?php
            while($perfil=mysqli_fetch_row($resultperfil_u)){
            echo "<option value='$perfil[0]' >$perfil[1]</option>";
             }?>
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
       
      </div>
    </div>
  </div>
</div>

<!-- Modal para edicion de datos -->

<div class="modal fade" id="modalEditaract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">Actualizar datos</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
            <input type="text" hidden="" id="idusuario_u" name="">
          <label id="lbnombre_u">Nombre</label>
        	<input type="text" name="" id="nombre_u" class="form-control input-sm" >
        	<label id="lbcarnet_u">Carnet</label>
        	<input type="text" name="" id="carnet_u" class="form-control input-sm">
        	<label id="lbusuario_u">Usuario</label>
        	<input type="text" name="" id="usuario_u" class="form-control input-sm">
          <label id="lbcontraseña_u">Contraseña</label>
        	<input type="password" name="" id="contraseña_u" class="form-control input-sm">
          <label id="lbperfil_u">Perfil</label>
          <select class="form-control input-sm" id="perfil_u" name="perfil_u"  >
            <option value="0">Seleccionar</option>
            <?php
            while($perfil=mysqli_fetch_row($resultperfil)){
            echo "<option value='$perfil[0]' >$perfil[1]</option>";
             }?>
          </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
        
      </div>
    </div>
  </div>
</div>

<div id="cabecera" width="100%">
	<h4>GESTION DE USUARIOS</h4>
  <table>
      <tr>
      <td> 
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo">
          <span class="glyphicon glyphicon-plus"></span> Agregar 
        </button>
        </td>
      </tr>
  </table> 
</div>   

<div id="printdetalle">
		<table class="table table-striped" id='tablaact'>
    <thead>
			<tr>
        <th scope="col">Nombre</th>
        <th scope="col">Carnet</th>
        <th scope="col">Usuario</th>

        <th scope="col">Perfil</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>
			</tr>
			</thead>
			<?php 
        
				while($ver=mysqli_fetch_row($result)){
					$datos=$ver[0]."||".$ver[1]."||".$ver[2]."||".$ver[3]."||".$ver[4];
			 ?>

			<tr>
				<td><?php echo $ver[1] ?></td>
				<td><?php echo $ver[2] ?></td>
        <td><?php echo $ver[3] ?></td>

        <td><?php echo $ver[5] ?></td> 
				<td>
					<button class="btn btn-warning glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEditaract" onclick="agregaformact('<?php echo $datos ?>')">
                          
					</button>
				</td>
				<td>
					<button class="btn btn-danger glyphicon glyphicon-remove" 
					    onclick="preguntarSiNoact('<?php echo $ver[0] ?>','<?php echo $ver[2] ?>','<?php echo $app ?>')">					
					</button>
				</td>
                
			</tr>
			<?php 
		}
			 ?>
		</table>

</div>

</body>
</html>



