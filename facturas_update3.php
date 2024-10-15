<?php
//var_dump($_POST);
$id=$_POST["id"];
$fecha=$_POST["fecha"];
$id_clientes=$_POST["id_clientes"];

include("db.php");
$sql="UPDATE `facturas` SET `fecha`='".$fecha."',`id_clientes`='".$id_clientes."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE `id`='".$id."'";
$mysqli->query($sql);   


    
$numLineas=$_POST["numLineas"];

for($i=1;$i<=$numLineas;$i++){

$id=$_POST["idlinea".$i];
$id_facturas=$id;
$id_productos=$_POST["id_productos".$i];

$cantidad=$_POST["cantidad".$i];
$preciounitario=$_POST["preciounitario".$i];
$base=$_POST["base".$i];
$descuento=$_POST["descuento".$i];
$iva=$_POST["iva".$i];
$precio=$_POST["precio".$i];

$sql="UPDATE `lineasfacturas` SET `id_facturas`='".$id_facturas."',`id_productos`='".$id_productos."',`updated_at`='".date("Y-m-d h:i:s")."' ";

$sql.=",`cantidad`='".$cantidad."'";
$sql.=",`preciounitario`='".$preciounitario."'";
$sql.=",`base`='".$base."'";
$sql.=",`descuento`='".$descuento."'";
$sql.=",`iva`='".$iva."'";
$sql.=",`precio`='".$precio."'";

$sql.=" WHERE `id`='".$id."'";
$mysqli->query($sql);

}

echo 1;
?>