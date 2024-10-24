<?php
//var_dump($_POST);
include("controller.php");

$tabla="proveedores";
$datos["razon_social"]=$_POST["razon_social"];
$datos["nombre_comercial"]=$_POST["nombre_comercial"];
$datos["cif"]=$_POST["cif"];
$datos["formapago"]=$_POST["formapago"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');
echo updateById($tabla,$datos,$_POST["id"]);
//header("location:proveedores.php");
?>