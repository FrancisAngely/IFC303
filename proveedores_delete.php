<?php
//var_dump($_POST);
$id=$_GET["id"];


include("controller.php");
echo delById("proveedores",$id);
//header("location:proveedores.php");
?>