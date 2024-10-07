<?php
//var_dump($_POST);
//SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1
$producto=$_POST["producto"];

$precio=$_POST["precio"];
$iva=$_POST["iva"];
$stock=$_POST["stock"];



include("db.php");
$sql="INSERT INTO `productos`(`id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at`) VALUES (";
$sql.="'NULL'";
$sql.=",'".$producto."'";
$sql.=",''";
$sql.=",'".$precio."'";
$sql.=",'".$iva."'";
$sql.=",'".$stock."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=")";

$mysqli->query($sql);


$imagen=$_FILES["imagen"];

if($imagen["name"]!=""){
    //directorio de subida
    $target_dir="productos/";
    //extension archivo que subo
    $imageTypeFile=strtolower(pathinfo($imagen["name"],PATHINFO_EXTENSION));
    //renombro el archivo
    $target_file=$target_dir."producto_".$mysqli->insert_id.".".$imageTypeFile;
    //subir el archivo y actualizar campo imagen en la tabla
    if(move_uploaded_file($imagen["tmp_name"],$target_file)){
      $sqlImg="UPDATE `productos` SET  `imagen`='".$target_file."'";
      $sqlImg.=" WHERE `id`=".$mysqli->insert_id;
      $mysqli->query($sqlImg);
    }
}

header("location:productos.php");

