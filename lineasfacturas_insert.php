<?php
//var_dump($_POST);



$id_facturas=$_POST["id_facturas"];
$id_productos=$_POST["id_productos"];

$cantidad=$_POST["cantidad"];
$preciounitario=$_POST["preciounitario"];
$base=$_POST["base"];
$descuento=$_POST["descuento"];
$iva=$_POST["iva"];
$precio=$_POST["precio"];
include("db.php");
$sql="INSERT INTO `lineasfacturas`(`id`, `id_facturas`, `id_productos`, `cantidad`, `preciounitario`, `base`, `descuento`, `iva`, `precio`, `created_at`, `updated_at`) VALUES (";
$sql.="'NULL'";
$sql.=",'".$id_facturas."'";
$sql.=",'".$id_productos."'";

$sql.=",'".$cantidad."'";
$sql.=",'".$preciounitario."'";
$sql.=",'".$base."'";
$sql.=",'".$descuento."'";
$sql.=",'".$iva."'";
$sql.=",'".$precio."'";

$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=")";

if($mysqli->query($sql)) echo $mysqli->insert_id;
else echo 0;
//header("location:clientes.php");
?>