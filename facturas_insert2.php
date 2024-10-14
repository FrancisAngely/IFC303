<?php
//var_dump($_POST);

$fecha=$_POST["fecha"];
$id_clientes=$_POST["id_clientes"];
include("db.php");
$sql="INSERT INTO `facturas`(`id`, `fecha`, `id_clientes`, `created_at`, `updated_at`) VALUES (";
$sql.="'NULL'";
$sql.=",'".$fecha."'";
$sql.=",'".$id_clientes."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=",'".date("Y-m-d h:i:s")."'";
$sql.=")";

if($mysqli->query($sql)){
    $mifactura=$mysqli->insert_id;
    for($i=1;$i<=$_POST["numproductos"];$i++){
        $id_productos=$_POST["id_productos".$i];

        $cantidad=$_POST["cantidad".$i];
        $preciounitario=$_POST["preciounitario".$i];
        $base=$_POST["base".$i];
        $descuento=$_POST["descuento".$i];
        $iva=$_POST["iva".$i];
        $precio=$_POST["precio".$i];
        
        $sql="INSERT INTO `lineasfacturas`(`id`, `id_facturas`, `id_productos`, `cantidad`, `preciounitario`, `base`, `descuento`, `iva`, `precio`, `created_at`, `updated_at`) VALUES (";
        $sql.="'NULL'";
        $sql.=",'".$mifactura."'";
        $sql.=",'".$id_productos."'";

        $sql.=",'".$cantidad."'";
        $sql.=",'".$preciounitario."'";
        $sql.=",'".$base."'";
        $sql.=",'".$descuento."'";
        $sql.=",'".$iva."'";
        $sql.=",'".$precio."'";

        $sql.=",'".date("Y-m-d h:i:s")."'";
        $sql.=",'".date("Y-m-d h:i:s")."'";
        $sql.=")";

        if($id_productos!="")
                $mysqli->query($sql);
    }
    echo 1;
        
}
else echo 0;
//header("location:clientes.php");
?>