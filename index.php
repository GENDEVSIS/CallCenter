<?php
require_once("consultasM.php");
$contrato=0;
$contratos=[];
if (isset($_REQUEST['contrato'])) $contrato=$_REQUEST['contrato'];
if (isset($_POST['cliente']))
{   
    $cliente=$_POST['cliente'];
    //echo "cliente:".$cliente." contrato:".$contrato;
    $apigen=new ppagos(1,$cliente,$contrato,0);
    $contratos=$apigen->buscarcontratos(1,$cliente);
}
?>
<!doctype html>
<html>
<head>
  <title>Prueba de Bootstrap 4</title> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/html2pdf.bundle.min.js"></script>
  <script src="js/datos.js"></script>
  <link rel="stylesheet" href="css/estilo.css" media="screen">
</head>
<script>

</script>
<body style="font-size: 14px;">
    <center>
        <h5>DATOS DEL CLIENTE</h5>
        <div style="width:600px" >
            <form action="index.php" method="post">
            <div class="form-group" >
                <label for="cliente">C.I.</label>
                <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Carnet de Identidad" style="font-size: 14px;">
            </div>
            <button type="submit" class="btn btn-outline-primary" style="font-size: 12px;">BUSCAR</button>
            </form>
        
        <table id='datos' class="table table-striped">
            <th>Nro.</th>
            <th>Contrato</th>
        <?php 
            $nro=0;
            foreach($contratos as $regpp):
                $nro+=1;
        ?>
            <tr>
                <td><?php echo $nro;?></td><td>
            <button type="button" id="boton" value="<?php echo $regpp[0];?>" onclick="abrirmodal('<?php echo $regpp[0];?>')"
            class="btn btn-outline-success" data-toggle="modal" data-target="#dialogo1" style="font-size: 12px;"><strong><?php echo $regpp[0];?></strong></button></td>
            </tr>
        <?php endforeach;?>
        <br>
        </div>
        <div class="modal fade bd-example-modal-lg" id="dialogo1" > 
            <div class="modal-dialog modal-lg" >
                <div class="modal-content" >
                    <div class="modal-header">
                    <button id="btnCrearPdf" class="btn btn-danger" style="font-size: 12px;"><strong>DESCARGAR DATOS DE CONTRATO</strong></button>    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    
                    </div>
                    
                    <div class="modal-body" >
                        
                        <div id="hijo" ></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    
                </div>
            </div>
        </div> 
    </center>
</body>
</html>
<script type="text/javascript">
    function abrirmodal(contrato){
        let cliente=document.getElementById('cliente').value;
        $("#hijo").load("planpagos.php?contrato="+contrato+"&cliente="+cliente);
    }
    function abrirmodalpago(contrato,cliente1,transaccion){
        let cliente=document.getElementById('cliente').value;
        $("#hijo2").load("comprobante.php?contrato="+contrato+"&cliente="+cliente+"&transaccion="+transaccion);
    }
</script>   