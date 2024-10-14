<?php
//var_dump($_POST);
$id=$_POST["id"];
$fecha=$_POST["fecha"];
$id_clientes=$_POST["id_clientes"];

include("db.php");
$sql="UPDATE `facturas` SET `fecha`='".$fecha."',`id_clientes`='".$id_clientes."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE `id`='".$id."'";
$mysqli->query($sql);   



$id=$_POST["idlinea"];
$id_facturas=$id;
$id_productos=$_POST["id_productos"];

$cantidad=$_POST["cantidad"];
$preciounitario=$_POST["preciounitario"];
$base=$_POST["base"];
$descuento=$_POST["descuento"];
$iva=$_POST["iva"];
$precio=$_POST["precio"];

$sql="UPDATE `lineasfacturas` SET `id_facturas`='".$id_facturas."',`id_productos`='".$id_productos."',`updated_at`='".date("Y-m-d h:i:s")."' ";

$sql.=",`cantidad`='".$cantidad."'";
$sql.=",`preciounitario`='".$preciounitario."'";
$sql.=",`base`='".$base."'";
$sql.=",`descuento`='".$descuento."'";
$sql.=",`iva`='".$iva."'";
$sql.=",`precio`='".$precio."'";

$sql.=" WHERE `id`='".$id."'";


if($mysqli->query($sql)) echo 1;
else echo 0;
?>