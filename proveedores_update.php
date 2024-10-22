<?php
//var_dump($_POST);
include("controller.php"); 
echo ActualizarProveedor($_POST); 

/*$id=$_POST["id"];
$razon_social=$_POST["razon_social"];
$nombre_comercial=$_POST["nombre_comercial"];
$cif=$_POST["cif"];
$formapago=$_POST["formapago"];

include("db.php");
$sql="UPDATE `proveedores` SET `razon_social`='".$razon_social."',`nombre_comercial`='".$nombre_comercial."',`cif`='".$cif."',`formapago`='".$formapago."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE `id`='".$id."'";


if($mysqli->query($sql)) echo 1;
else echo 0;*/
//header("location:proveedores.php");
?>