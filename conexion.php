<?php

$db = new PDO("informix:host=192.168.10.80; service=1531;database=tbsai; server=online01; protocol=onsoctcp;EnableScrollableCursors=1;", "tbsai", "tbsai");
function conexion_190(){
    $db = new PDO("informix:host=192.168.10.80; service=1531;database=tbsai; server=online01; protocol=onsoctcp;EnableScrollableCursors=1;", "tbsai", "tbsai");
    //$db = new PDO("informix:host=192.168.2.190; service=1530;database=tbsai; server=online; protocol=onsoctcp;EnableScrollableCursors=1;", "tbsai", "tbsai");
    return $db;
}

function conexion_1050(){
    $db = new PDO("informix:host=192.168.10.80; service=1531;database=tbsai; server=online01; protocol=onsoctcp;EnableScrollableCursors=1;", "tbsai01", "tbsai01");
    //$db = new PDO("informix:host=192.168.10.50; service=1531;database=tbsai; server=online01; protocol=onsoctcp;EnableScrollableCursors=1;", "tbsai01", "tbsai01");
    return $db;
}

function conexionmysql(){
    $servidor="192.168.10.6:3306";
    $usuario="genmysql";
    $password="Gen4718.";
    $bd="gen_gestioncc";
    $conexion=mysqli_connect($servidor,$usuario,$password,$bd);
    return $conexion;
}

function conexion(){

    // $db = new PDO("informix:DSN=tbsai_nm", "tbsai01", "tbsai01");
    $db = new PDO("informix:host=192.168.10.50; service=1531;database=tbsai; server=online01; protocol=onsoctcp;EnableScrollableCursors=1;", "tbsai01", "tbsai01");
    return $db;
    
}
?>
