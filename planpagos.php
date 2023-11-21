<?php
date_default_timezone_set('America/La_Paz');
include('conexion.php');
require_once("consultasM.php");
$contrato=0;
if (isset($_REQUEST['contrato'])) $contrato=$_REQUEST['contrato'];
if (isset($_REQUEST['cliente'])) $cliente=$_REQUEST['cliente'];

$fechahora=date("d-m-Y h:m:s");
$fechahoralit=date("Ymd_hms");
$datospagos=new ppagos(1,$cliente,$contrato,0);
$datoscontrato=$datospagos->buscarcontratodatos(1,$contrato);
$datosppagos=$datospagos->buscarplanpagos(1,$contrato);
?>

<html lang="es">
<head>
	<title>GEN Apps
	</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--     <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->
	<!--===============================================================================================-->
<script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
<!-- <script src="js/jspdf.debug.js"></script> -->
<script src="js/html2pdf.bundle.min.js"></script>
    <!--Nuestro script, que se encarga de crear el PDF usando la librería-->
   
</head>
<body >
<div id="pdf" >
 <center>   
    <div class="row">
        <div class="col">
            
        </div>   
        <div class="col">
           <h5>INMOBILIARIA MI LOTE S.A.</h5>
        </div>   
        <div class="col">
        <?php echo $fechahora;?>
        </div> 
    </div>
 
<input type="hidden" id="fechahora" name="fechahora" value="<?php echo $fechahoralit?>">
<h5>LISTADO DE PLAN DE PAGOS</h5>
<table id='mytable'>
<?php
    $moneda='$us.';
    foreach($datoscontrato as $registro):
        $totalprecio=$registro[2];
        echo "
        <input type='hidden' id='nrocontrato' name='nrocontrato' value='$registro[0]'>
        <input type='hidden' id='cliente' name='cliente' value='$cliente'>
        <tr>
            <td>Nro. Contrato</td><td>: $registro[0]</td>
        </tr>
        <tr>
            <td>Cliente</td><td>: $registro[1]</td>
        </tr>
        <tr>
            <td>Total Contrato</td><td>: $registro[2] $moneda </td>
        </tr>
        <tr>
            <td>Cuota Inicial</td><td>: $registro[3] $moneda</td>
        </tr>
        <tr>
            <td>Total Plan Pagos</td><td>: $registro[4] $moneda</td>
        </tr>
        <tr>
            <td>Plazo</td><td>: $registro[5] cuotas</td>
        </tr>
        <tr>
            <td>Urbanizacion</td><td>: $registro[6]</td>
        </tr>
        <tr>
            <td>UV.</td><td>: $registro[7]</td>
        </tr>
        <tr>
            <td>Manzano</td><td>: $registro[8]</td>
        </tr>
        <tr>
            <td>Lote</td><td>: $registro[9]</td>
        </tr>
        <tr>
            <td>Estado</td><td>: $registro[10]</td>
        </tr>
        ";
    endforeach;
    echo " </table>";
?>
<br>
<table id='mytable2' width="100%">
<th>Nro.</th>
<th>Dia de Pago</th>
<th>Importe Cuota</th>
<th>Saldo</th>
<th>Cargo</th>
<th>Total Pago</th>
<th>Pagada</th>
<th>Fecha Pago</th>
<th>Via de Pago</th>
<th>Nro. Trans.</th>
<?php
    $moneda='$us.';
    //$result = $db->query($sqlplanpagos);
    $nro=0;
    $saldo=$totalprecio;
    foreach($datosppagos as $regpp):
        $nro+=1;
        $cuota=$regpp[2]+$regpp[3]+$regpp[4];
        $saldo=round($saldo-$cuota,2);
        $fechacuota=date('d-m-Y',strtotime($regpp[1]));
        $fechapago=date('d-m-Y',strtotime($regpp[7]));
        if ($fechapago=="01-01-1970") $fechapago="";
        echo "
        <tr>
            <td>$nro</td>
            <td>$fechacuota</td>
            <td>$cuota</td>
            <td>$saldo</td>
            <td>$regpp[4]</td>
            <td>$regpp[5]</td>
            <td>$regpp[6]</td>
            <td>";
            if ($regpp[6]<>"N") echo $fechapago;
           echo " </td>
            <td>$regpp[8]</td>
            <td>";
            if ($regpp[8]<>""){
            ?>
<button type="button" id="boton" value="<?php echo $regpp[9];?>" onclick="abrirmodalpago('<?php echo $contrato;?>','<?php echo $cliente;?>','<?php echo $regpp[9];?>')"
            class="btn btn-outline-success" data-toggle="modal" data-target="#dialogo2" style="font-size: 12px;"><strong><?php echo $regpp[9];?></strong></button></td>
           <?php }  echo " </td>
        </tr>
        ";
    endforeach;
    echo " </table>";
?>
<div class="modal fade bd-example-modal-lg" id="dialogo2"  > 
            <div class="modal-dialog modal-lg" style="width:750px;" >
                <div class="modal-content" >
                    
                    <div class="modal-header" style="margin: 0 auto;">
                    
                    <button id="btnCrearPdf2" onclick="imprimir()" class="btn btn-danger" style="font-size: 12px;"><strong>DESCARGAR COMPROBANTE</strong></button>    
                    

                    </div>
                    
                    <div class="modal-body" style="height:650px;">
                        
                        <div id="hijo2" ></div>
                    </div>
                
                    
                </div>
            </div>
        </div> 
</center>
</div>


</body>
</html>
<script>
function imprimir(){
    //alert("hola");
    let transac=document.getElementById('transac').value;
    let nrocontrato=document.getElementById('nrocontrato').value;
    const $elementoParaConvertir = document.querySelector("#hijo2"); // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: 1,
                filename: nrocontrato+'_Transac='+transac+'.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "a3",
                    orientation: 'portrait' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err)); 
}
</script>