<?php
//var_dump($_POST);
$id=$_GET["id"];


include("db.php");
$sql="DELETE FROM `direcciones_proveedores` WHERE `id`='".$id."'";


$mysqli->query($sql);
header("location:direcciones_proveedores.php");
?>