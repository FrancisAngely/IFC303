<?php
include("controller.php");
//var_dump($_POST);
$id=$_GET["id"];

echo EliminarCliente($id);
//header("location:clientes.php");
?>