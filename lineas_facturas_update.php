<?php
//var_dump($_POST);
$id = $_POST["id"];
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
`id_facturas`='" . $id_facturas . "',
`id_productos`='" . $id_productos . "',
`updated_at`='" . date("Y-m-d h:i:s") . "' ";

$sql .= ",`cantidad`='" . $cantidad . "'";
$sql .= ",`precio_unitario`='" . $precio_unitario . "'";
$sql .= ",`base`='" . $base . "'";
$sql .= ",`descuento`='" . $descuento . "'";
$sql .= ",`iva`='" . $iva . "'";
$sql .= ",`precio`='" . $precio . "'";

$sql .= " WHERE `id`='" . $id . "'";


if ($mysqli->query($sql)) echo 1;
else echo 0;
