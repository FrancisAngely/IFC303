<?php
//var_dump($_POST);

include("controller.php");

//`id`, `nombre`, `apellidos`, `created_at`, `updated_at`
$tabla="proveedores";
$campos="`id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at`";
$valores="'NULL','".$_POST["razon_social"]."','".$_POST["nombre_comercial"]."','".$_POST["cif"]."','".$_POST["formapago"]."','".date('Y-m-d h:i:s')."','".date('Y-m-d h:i:s')."'";


//echo save($tabla,$campos,$valores);

//$datos["id"]="NULL";
$datos["razon_social"]=$_POST["razon_social"];
$datos["nombre_comercial"]=$_POST["nombre_comercial"];
$datos["cif"]=$_POST["cif"];
$datos["formapago"]=$_POST["formapago"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');
echo saveV3($tabla,$datos);
//echo InsertarProveedor($_POST);
//header("location:proveedores.php");
?>