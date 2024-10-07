<?php
//var_dump($_POST);
$id=$_POST["id"];
$id_proveedor=$_POST["id_proveedor"];
$direccion=$_POST["direccion"];
$localidad=$_POST["localidad"];
$provincia=$_POST["provincia"];
$cp=$_POST["cp"];
include("db.php");
$sql="UPDATE `direcciones_proveedores` SET `id_proveedor`='".$id_proveedor."',`direccion`='".$direccion."',`localidad`='".$localidad."',`provincia`='".$provincia."',`cp`='".$cp."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE `id`='".$id."'";


if($mysqli->query($sql))echo 1;
else echo 0;
//header("location:direcciones_proveedores.php");
?>