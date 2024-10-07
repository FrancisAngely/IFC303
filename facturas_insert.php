<?php
//var_dump($_POST);

$fecha=$_POST["fecha"];
$id_clientes=$_POST["id_clientes"];

include("db.php");
$sql="INSERT INTO `facturas`(`id`, `fecha`, `id_clientes`, `created_at`, `updated_at`) VALUES (";
$sql.="'NULL'";
$sql.=",'".$fecha."'";
$sql.=",'".$id_clientes."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=")";

if($mysqli->query($sql)) echo $mysqli->insert_id;
else echo 0;
?>