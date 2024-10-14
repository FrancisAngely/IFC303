<?php
include("db.php");
$resultado=array();
$sql="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE `id`=".$_POST["id_productos"];
$resultado=0;
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        $fila=$query->fetch_assoc();
        $resultado=$fila;
    }

echo implode(";",$resultado);
?>