<?php
//var_dump($_POST);
$id=$_POST["id"];
$fecha=$_POST["fecha"];
$id_clientes=$_POST["id_clientes"];
$id_facturas=$id;

$estado=1;

include("db.php");
$sql="UPDATE `facturas` SET `fecha`='".$fecha."',`id_clientes`='".$id_clientes."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE `id`='".$id."'";
if($mysqli->query($sql))$estado=1;else $estado=0;


$sql="DELETE FROM `lineasfacturas` WHERE id_facturas=".$id_facturas;
if($mysqli->query($sql))$estado=1;else $estado=0;

    
$numLineas=$_POST["numLineas"];

for($i=1;$i<=$numLineas;$i++){

//$id=$_POST["idlinea".$i];

$id_productos=$_POST["id_productos".$i];

$cantidad=$_POST["cantidad".$i];
$preciounitario=$_POST["preciounitario".$i];
$base=$_POST["base".$i];
$descuento=$_POST["descuento".$i];
$iva=$_POST["iva".$i];
$precio=$_POST["precio".$i];
    
    
if($id_productos!=""){
    
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
if($mysqli->query($sql))$estado=1;else $estado=0;
}

}
echo $estado;
?>