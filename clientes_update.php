<?php
//var_dump($_POST);
$id=$_POST["id"];
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];

include("db.php");
$sql="UPDATE `clientes` SET `nombre`='".$nombre."',`apellidos`='".$apellidos."',`updated_at`='".date("Y-m-d h:i:s")."' WHERE `id`='".$id."'";


if($mysqli->query($sql)) echo 1;
else echo 0;
?>