<?php
$id=$_GET["id"];

include("db.php");
$sql="DELETE FROM `facturas` WHERE `id`='".$id."'";

if($mysqli->query($sql)) echo 1;
else echo 0;

?>