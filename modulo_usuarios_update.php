<?php
include("controller.php"); 

$tabla="ususarios";

$datos["id_roles"]=$_POST["id_roles"];
$datos["usuario"]=$_POST["usuario"];
$datos["email"]=$_POST["email"];
$datos["updated_at"]=date('Y-m-d h:i:s');

if($pass_Ant!=$_POST["password"]); 

    $datos["password"]=md5($_POST["password"]);
    
    echo updateById($tabla, $datos, $_POST["id"]); 

echo saveV($tabla,$datos);
















?>