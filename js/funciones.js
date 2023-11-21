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
						$('#lbusuario').html("<span style='color:red;'>Usuario "+usuario+" ya existe</span>");
						$("#guardarnuevo").attr('disabled',true); //Desabilito el Botton
					}else{
						$('#lbusuario').html("<span style='color:black;'>Usuario</span>");
						$("#guardarnuevo").attr('disabled',false); //Habilito el Botton
					}
				}
			});
		}
	});

	$("#usuario_u").on("keyup", function() {
		var usuario = $("#usuario_u").val(); //CAPTURANDO EL VALOR DE INPUT CON ID usuario
		var longitudusuario = $("#usuario_u").val().length; //CUENTO LONGITUD

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
						$('#lbusuario_u').html("<span style='color:red;'>Usuario "+usuario+" ya existe</span>");
						$("#actualizadatos").attr('disabled',true); //Desabilito el Botton
					}else{
						$('#lbusuario_u').html("<span style='color:black;'>Usuario</span>");
						$("#actualizadatos").attr('disabled',false); //Habilito el Botton
					}
				}
			});
		}
	});

	$('#guardarnuevo').click(function(){
		var nombre=$('#nombre').val();
		var carnet=$('#carnet').val();
		var usuario=$('#usuario').val();
		var contraseña=$('#contraseña').val();
		var perfil=$('#perfil').val();
		if (nombre==''){
			$('#lbnombre').html("<span style='color:red;'>Nombre</span>");
			setTimeout(function(){$('#lbnombre').html("<span style='color:black;'>Nombre</span>");	},3000);
			$('#nombre').focus();
			return false;
		}
		if (carnet==''){
			$('#lbcarnet').html("<span style='color:red;'>Carnet</span>");
			setTimeout(function(){$('#lbcarnet').html("<span style='color:black;'>Carnet</span>");	},3000);
			$('#carnet').focus();
			return false;
		}
		if (usuario==''){
			$('#lbusuario').html("<span style='color:red;'>Usuario</span>");
			setTimeout(function(){$('#lbusuario').html("<span style='color:black;'>Usuario</span>");	},3000);
			$('#usuario').focus();
			return false;
		}
		if (contraseña==''){
			$('#lbcontraseña').html("<span style='color:red;'>Contraseña</span>");
			setTimeout(function(){$('#lbcontraseña').html("<span style='color:black;'>Contraseña</span>");	},3000);
			$('#contraseña').focus();
			return false;
		}
		if (perfil==''){
			$('#lbperfil').html("<span style='color:red;'>Perfil</span>");
			setTimeout(function(){$('#lbperfil').html("<span style='color:black;'>Perfil</span>");	},3000);
			$('#perfil').focus();
			return false;
		}
		insertarDatos();
	});

	$('#actualizadatos').click(function(){
	
		var nombre=$('#nombre_u').val();
		var carnet=$('#carnet_u').val();
		var usuario=$('#usuario_u').val();
		var contraseñau=$('#contraseña_u').val();
		var perfil=$('#perfil_u').val();
		if (nombre==''){
			$('#lbnombre_u').html("<span style='color:red;'>Nombre</span>");
			setTimeout(function(){$('#lbnombre_u').html("<span style='color:black;'>Nombre</span>");	},3000);
			$('#nombre_u').focus();
			return false;
		}
		if (carnet==''){
			$('#lbcarnet_u').html("<span style='color:red;'>Carnet</span>");
			setTimeout(function(){$('#lbcarnet_u').html("<span style='color:black;'>Carnet</span>");	},3000);
			$('#carnet_u').focus();
			return false;
		}
		if (usuario==''){
			$('#lbusuario_u').html("<span style='color:red;'>Usuario</span>");
			setTimeout(function(){$('#lbusuario_u').html("<span style='color:black;'>Usuario</span>");	},3000);
			$('#usuario_u').focus();
			return false;
		}
		if (contraseñau==''){
			$('#lbcontraseña_u').html("<span style='color:red;'>Contraseña</span>");
			setTimeout(function(){$('#lbcontraseña_u').html("<span style='color:black;'>Contraseña</span>");	},3000);
			$('#contraseña_u').focus();
			return false;
		}
		if (perfil==''){
			$('#lbperfil_u').html("<span style='color:red;'>Perfil</span>");
			setTimeout(function(){$('#lbperfil_u').html("<span style='color:black;'>Perfil</span>");	},3000);
			$('#perfil_u').focus();
			return false;
		}
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