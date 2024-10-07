<?php
include("db.php");

//var_dump($_POST);
//SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1
$id=$_POST["id"];
$producto=$_POST["producto"];
//$imagen=$_POST["imagen"];
$precio=$_POST["precio"];
$iva=$_POST["iva"];
$stock=$_POST["stock"];

$imagen=$_FILES["imagen"];
$subido=0;
if($imagen["name"]!=""){
    //borrar la imagen
    $sqlImg="SELECT `imagen` FROM productos WHERE `id`=".$id;
    $result=$mysqli->query($sqlImg);
    if($result->num_rows>0){
        $fila=$result->fetch_assoc();
        $imagenAnt=$fila["imagen"];
        if(file_exists($imagenAnt)){
            unlink($imagenAnt);
        }
    }
    
    
    //directorio de subida
    $target_dir="productos/";
    //extension archivo que subo
    $imageTypeFile=strtolower(pathinfo($imagen["name"],PATHINFO_EXTENSION));
    //renombro el archivo
    $target_file=$target_dir."producto_".$id.".".$imageTypeFile;
    //subir el archivo y actualizar campo imagen en la tabla
    if(move_uploaded_file($imagen["tmp_name"],$target_file)){
      $subido=1;
    }
}


$sql="UPDATE `productos` SET ";

$sql.="`producto`='".$producto."'";
if($subido==1){
$sql.=",`imagen`='".$target_file."'";
}
$sql.=",`precio`='".$precio."'";
$sql.=",`iva`='".$iva."'";
$sql.=",`stock`='".$stock."'";

$sql.=",`updated_at`='".date("Y-m-d h:i:s")."'";
$sql.=" WHERE `id`='".$id."'";

$mysqli->query($sql);
header("location:productos.php");
?>