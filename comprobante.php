<?php
date_default_timezone_set('America/La_Paz');
include('conexion.php');
require_once("consultasM.php");
$contrato=0;
$transaccion=0;
if (isset($_REQUEST['contrato'])) $contrato=$_REQUEST['contrato'];
if (isset($_REQUEST['transaccion'])) $transaccion=$_REQUEST['transaccion'];
if (isset($_REQUEST['cliente'])) $cliente=$_REQUEST['cliente'];

$fechahora=date("d-m-Y h:m:s");
$fechahoralit=date("Ymd_hms");
$datospagos=new ppagos(1,$cliente,$contrato,$transaccion);
$datoscontrato=$datospagos->buscarcontratodatos(1,$contrato);
$datostransac=$datospagos->buscartransaccion(1,$contrato,$transaccion);

foreach($datoscontrato as $registro):
    $clientenombre=$registro[1];
    $urbanizacion=$registro[11]." UV ".$registro[7]." MZ ".$registro[8]." LT ".$registro[9];
    $clientedir=$registro[12];
    $clientetelf=$registro[13];
    $saldo=number_format($registro[14],2);
endforeach;

$nrocuotas="";

$moneda='$us.';
$valorcuotas=0;
$penalidades=0;
$totalpenalidades="";
foreach($datostransac as $regtran):
    $fechatran=date('d/m/Y',strtotime($regtran[0]));
    $horatran=$regtran[1];
    $totalpago=$regtran[3];
    $nrocuotas.=$regtran[4]." ";
    $viapago=$regtran[5];
    $user=$regtran[6];
    $nrocaja=$regtran[7];
    if ($nrocaja<>"") $nrocaja="00".$nrocaja;
    else $nrocaja="0000";
    $usercaja=$nrocaja.":".$user;
    $valorcuotas+=$regtran[8]+$regtran[9];
    $penalidades+=$regtran[10];
endforeach;
$valorcuotas=number_format($valorcuotas,2);
$penalidades=number_format($penalidades,2);

require_once "CifrasEnLetras.php";
$v=new CifrasEnLetras(); 
//Convertimos el total en letras
$arrmonto=explode(".",$totalpago);
$entero=$arrmonto[0];
$decimal=$arrmonto[1];
$letra=($v->convertirEurosEnLetras($entero));
$letra=strtoupper($letra);
$arrletra=explode("SOLES",$letra);

$letra=$arrletra[0];
$decimal=$arrmonto[1];
$montoliteral=$letra.$decimal."/100 DOLARES";

$valorcuotas=number_format($valorcuotas,2);
$penalidades=number_format($penalidades,2);
$totalpago=number_format($totalpago,2);

if ($penalidades>0){
    $totalpenalidades="
        <tr>
            <td>PENALIDADES</td>
            <td>$moneda</td>
            <td align='right'>$penalidades</td>
        </tr>";
}
?>

<html lang="es">
<head>
	<title>GEN Apps
	</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<!--===============================================================================================-->
<script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
<!-- <script src="js/jspdf.debug.js"></script> -->
<script src="js/html2pdf.bundle.min.js"></script>
    <!--Nuestro script, que se encarga de crear el PDF usando la librería-->
</head>
<body >

<div id="pdf" >
 <center>   
<?php

    echo "<input type='hidden' id='transac' name='transac' value='$transaccion'>
    COBRO $viapago <br>
    Numero de Contrato ($contrato) <br>
    $urbanizacion<br>
    EN DOLARES<br>
    $fechatran<br><br>
    <table id='mytable' width='600px'>
        <tr>
            <td>$clientenombre</td>
            <td>N.tra:</td>
            <td align='right'>$transaccion</td>
        </tr>
        <tr>
            <td>$clientedir</td>
            <td>Fecha:</td>
            <td align='right'>$fechatran</td>
        </tr>
        <tr>
            <td>Telf.: $clientetelf</td>
            <td>Hora:</td>
            <td align='right'>$horatran</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td>VALOR CUOTAS</td>
            <td>$moneda</td>
            <td align='right'>$valorcuotas</td>
        </tr>
        $totalpenalidades
        <tr>
            <td></td>
            <td></td>
            <td align='right'>=======</td>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td>$moneda</td>
            <td align='right'>$totalpago</td>
        </tr>
        <tr>
            <td>Cuotas(s) pagada(s) No.: $nrocuotas</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan='3'>Son $montoliteral</td>
        </tr>
        <tr>
            <td colspan='3'>Saldo Contrato: $saldo</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan='3'>NO ES VALIDO PARA CREDITO FISCAL</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td colspan='3'><center>$clientenombre</center></td>
        </tr>
        <tr>
            <td colspan='3'>$usercaja</td>
        </tr>
        <tr>
            <td colspan='3'>Antes de firmar verifique los datos</td>
        </tr>
    </table>
    </center>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    ";
?> 
</div>
</body>
</html>