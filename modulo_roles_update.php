<?php
include("controller.php");
$tabla="roles";


$datos["id"]=$_POST["id"];
$datos["role"]=$_POST["role"];
$datos["updated_at"]=date('Y-m-d h:i:s');

echo updateById($tabla,$datos,$_POST["id"])
?>