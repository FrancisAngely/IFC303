<?php
//var_dump($_POST);
$id=$_GET["id"];


include("db.php");
$sql="DELETE FROM `productos` WHERE `id`='".$id."'";


$mysqli->query($sql);
header("location:productos.php");
?>