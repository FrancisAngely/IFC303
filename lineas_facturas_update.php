<?php
//var_dump($_POST);
//$id=$_POST["id"];
$id_facturas = $_POST["id_facturas"];
$id_productos = $_POST["id_productos"];
$cantidad = $_POST["cantidad"];
$precio_unitario = $_POST["precio_unitario"];
$base = $_POST["base"];
$descuento = $_POST["descuento"];
$iva = $_POST["iva"];
$precio = $_POST["precio"];

include("db.php");

$sql = "UPDATE `lineas_facturas` SET 
`id`='" . $id . "'
,`id_facturas`='" . $id_facturas . "'
,`id_productos`='" . $id_productos . "'
,`cantidad`='" . $cantidad . "'
,`precio_unitario`='" . $precio_unitario . "'
,`base`='" . $base . "'
,`descuento`='" . $descuento . "'
,`iva`='" . $iva . "'
,`precio`='" . $precio . "'
,`updated_at`='" . date("Y-m-d h:i:s") . "' WHERE `id`='" . $id . "'";


if ($mysqli->query($sql)) echo 1;
else echo 0;
