<?php
require_once("conexion.php");
class ppagos {
    private $empresa;
    private $cliente;
    private $contrato;
    private $transaccion;

    public function __construct($empresa,$cliente,$contrato,$transaccion) {
       
        $this->empresa=$empresa;
        $this->cliente=$cliente;
        $this->contrato=$contrato;
        $this->transaccion=$transaccion;
        
    }

    public function buscarcontratos($empresa,$cliente)
    {

        if($empresa==1) $con=conexion_190();
        elseif($empresa==2) $con=conexion_1050();

        $contratos=[];
        $sqlcontrato = "Select ilmprnpre,gbage.gbagenomb 
        from ilmpr, gbage
        where ilmprcage=gbagecage 
        and gbage.gbagendid='$cliente'";

        $query=$con->query($sqlcontrato);
        while ($r= $query->fetch()) {$contratos[]=$r;}
        return $contratos;
    }
        public function buscarcontratodatos($empresa,$contrato)
        {

            if($empresa==1) $con=conexion_190();
            elseif($empresa==2) $con=conexion_1050();

            $datos=[];
            $sqlcontrato = "select 	con.ilmprnpre,cli.gbagenomb,
            con.ilmprmapr,
            con.ilmprcini,
            con.ilmprmdes,
            con.ilmprplzo,
            con.ilmpruneg ||' - '|| une.cnunedesc,
            con.ilmprubn2,
            con.ilmprubn3,
            con.ilmprnlot,
            est.ilcondesc,
            une.cnunedesc,
            cli.gbagedir1,
            cli.gbagetlex,
            con.ilmprsald,
            cli.gbagecage
            from ilmpr con,gbage cli,cnune une,ilcon est 
            where con.ilmprcage=cli.gbagecage 
            and con.ilmpruneg = une.cnuneuneg
            and con.ilmprstat = est.ilconcorr and est.ilconpref=12
            and con.ilmprnpre in ($contrato)";

            $query=$con->query($sqlcontrato);
            while ($r= $query->fetch()) {$datos[]=$r;}
            return $datos;
        }

        public function buscarplanpagos($empresa,$contrato)
        {

            if($empresa==1) $con=conexion_190();
            elseif($empresa==2) $con=conexion_1050();

            $planpagos=[];
            $sqlplanpagos = "Select ilppgnpre,ilppgfech,ilppgcapi,ilppginte,ilppgcarg,ilppgtota,
            ilppgmpag,ilppgfpag,
            (select ilviadesc from ilvia inner join ilhtr on ilviacvia=ilhtrcvia and ilhtrntra=ilppgntra and ilhtrnpre=ilppgnpre),
            ilppgntra 
            from ilppg 
            /*left join ilhtr on ilppgntra=ilhtrntra and ilppgnpre=ilhtrnpre*/
            where ilppgnpre =$contrato
            order by ilppgnpag";

            $query=$con->query($sqlplanpagos);
            while ($r= $query->fetch()) {$planpagos[]=$r;}
            return $planpagos;
        }

        public function buscartransaccion($empresa,$contrato,$transaccion)
        {

            if($empresa==1) $con=conexion_190();
            elseif($empresa==2) $con=conexion_1050();

            $transacciones=[];
            $sqltransac = "
            Select 	ilhtrfreg,
                    ilhtrhora,
                    ilhtrntra,
                    ilhtrimpt,
                    ilppgnpag,
                    (select ilviadesc from ilvia where ilviacvia=ilhtrcvia),
                    ilhtruser,
                    (select adusrcaja from adusr where adusrusrn=ilhtruser),
                    ilppgcapi,
                    ilppginte,
                    ilppgcarg
            from 	ilppg 
                    inner join ilhtr on ilppgntra=ilhtrntra 
                    and ilppgnpre=ilhtrnpre
            where 	ilppgnpre =$contrato 
                    and ilhtrntra = $transaccion
            order by ilppgnpag";

            $query=$con->query($sqltransac);
            while ($r= $query->fetch()) {$transacciones[]=$r;}
            return $transacciones;
        }
    }
    
?>