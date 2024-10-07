<?php
//var_dump($_POST);
$id=$_GET["id"];


include("db.php");
$sql="DELETE FROM `proveedores` WHERE `id`='".$id."'";


if($mysqli->query($sql)) echo 1;
else echo 0;
//header("location:proveedores.php");
?>