<?php
//var_dump($_POST);

$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
include("db.php");
$sql="INSERT INTO `clientes`(`id`, `nombre`, `apellidos`, `created_at`, `updated_at`) VALUES (";
$sql.="'NULL'";
$sql.=",'".$nombre."'";
$sql.=",'".$apellidos."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=")";

if($mysqli->query($sql)) echo $mysqli->insert_id;
else echo 0;
//header("location:clientes.php");
?>