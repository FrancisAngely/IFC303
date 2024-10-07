<?php
//var_dump($_POST);
$id=$_POST["id"];
$fecha=$_POST["fecha"];
$id_clientes=$_POST["id_clientes"];

include("db.php");
$sql="UPDATE `facturas` SET `id`='".$id."',`fecha`='".$fecha."',`id_clientes`='".$id_clientes."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE `id`='".$id."'";


if($mysqli->query($sql)) echo 1;
else echo 0;
?>