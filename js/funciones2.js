
$(document).ready(function(){

//Validando si existe la usuario en BD antes de enviar el Form
	$("#usuario").on("keyup", function() {
		var usuario = $("#usuario").val(); //CAPTURANDO EL VALOR DE INPUT CON ID usuario
		var longitudusuario = $("#usuario").val().length; //CUENTO LONGITUD
	
		//Valido la longitud 
		if(longitudusuario >= 3){
		var dataString = 'usuario=' + usuario;
	
			$.ajax({
				url: 'verificausuario.php',
				type: "GET",
				data: dataString,
				dataType: "JSON",
	
				success: function(datos){
					if( datos.success == 1){
						$("#guardarnuevo").attr('disabled',true); //Desabilito el Botton
					}else{
						$("#guardarnuevo").attr('disabled',false); //Habilito el Botton
					}
				}
			});
		}
	});

	$('#guardarnuevo').click(function(){
		var nombre=$('#nombre').val();
		if (nombre==''){
			$('#lbnombre').html("<span style='color:red;'>Nombre</span>");
			setTimeout(function(){
				$('#lbnombre').html("<span style='color:black;'>Nombre</span>");	
			},3000);
			$('#nombre').focus();
			return false;
		}
		insertarDatos();
	});
	$('#actualizadatos').click(function(){
	  actualizaDatosact();
	});
});

function preguntarSiNoact(id,oficina,app){
	//window.alert("usuarios.php?oficina="+oficina);
	   alertify.confirm('Eliminar Datos', '¿Está seguro de dar Baja este Usuario?', 
	 
					   function(){ eliminarDatosact(id,oficina,app) }
				   , function(){ alertify.error('Se cancelo')});
   }
   
function eliminarDatosact(id,oficina,app){
		cadena="id=" + id;
		   $.ajax({
			   type:"POST",
			   url:"usuarios/borrar.php",
			   data:cadena,
			   success:function(r){
				   if(r==1){                  
			   alertify.success("Dado de Baja con exito!");
			   window.location = "usuarios.php";
				   }else{
				   }
			   }
		   }); 
   }
   
   function actualizaDatosact(){
	   idu=$('#idusuario_u').val();
	   nombre_u=$('#nombre_u').val();
	   carnet_u=$('#carnet_u').val();
	   usuario_u=$('#usuario_u').val();
	   password_u=$('#contraseña_u').val();
	   perfil_u=$('#perfil_u').val();

	   cadenau= "id=" + idu +
			   "&nombre=" + nombre_u + 
			   "&carnet=" + carnet_u +
			   "&usuario=" + usuario_u +
			   "&password=" + password_u +
			   "&perfil=" + perfil_u;
	   $.ajax({
		   type:"POST",
		   url:"usuarios/actualizar.php",
		   data:cadenau,
		   success:function(r){
			   if(r==1){
		   			window.location = "usuarios.php";
			   }else{
				   	alertify.error("Fallo en el servidor"+"-"+r);
			   }
		   }
	   });
   }

   function insertarDatos(){
	idu=$('#idusuario').val();
	nombre=$('#nombre').val();
	carnet=$('#carnet').val();
	usuario=$('#usuario').val();
	password=$('#contraseña').val();
	perfil=$('#perfil').val();
	
	cadenau= "id=" + idu +
			"&nombre=" + nombre + 
			"&carnet=" + carnet +
			"&usuario=" + usuario +
			"&password=" + password +
			"&perfil=" + perfil;
	$.ajax({
		type:"POST",
		url:"usuarios/insertar.php",
		data:cadenau,
		success:function(r){
			if(r==1){
					window.location = "usuarios.php";
			}else{
					alertify.error("Fallo en el Servidor"+"-"+r);
			}
		}
	});
}
	 
   function agregaformact(datosa){
	   da=datosa.split('||');
	   $('#idusuario_u').val(da[0]); 
	   $('#nombre_u').val(da[1]);
	   $('#carnet_u').val(da[2]);
	   $('#usuario_u').val(da[3]);
	   //$('#password_u').val(da[4]);
	   $('#perfil_u').val(da[4]);
   }