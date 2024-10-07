<?php
//var_dump($_POST);
//SELECT `id`, `id_proveedor`, `direccion`, `localidad`, `provincia`, `cp`, `created_at`, `updated_at` FROM `direcciones_proveedores` WHERE 1
$id_proveedor=$_POST["id_proveedor"];
$direccion=$_POST["direccion"];
$localidad=$_POST["localidad"];
$provincia=$_POST["provincia"];
$cp=$_POST["cp"];
include("db.php");
$sql="INSERT INTO `direcciones_proveedores`(`id`, `id_proveedor`, `direccion`, `localidad`, `provincia`, `cp`, `created_at`, `updated_at`) VALUES (";
$sql.="'NULL'";
$sql.=",'".$id_proveedor."'";
$sql.=",'".$direccion."'";
$sql.=",'".$localidad."'";
$sql.=",'".$provincia."'";
$sql.=",'".$cp."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=")";

if($mysqli->query($sql)) echo $mysqli->insert_id;
else 0;
//header("location:direcciones_proveedores.php");
?>