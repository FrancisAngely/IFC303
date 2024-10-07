<?php
include("db.php");
$provincia=$_POST["provincia"];
$sql="SELECT `id`, `id_provincias`, `cmun`, `dc`, `localidad`, `cretead_at`, `updated_at` FROM `localidades` WHERE 1";
$sql.=" AND `id_provincias`='".$provincia."'";
$result=$mysqli->query($sql);
if($result->num_rows>0){
    $respuesta="<option></option>";
    while($fila=$result->fetch_assoc()){
     $respuesta.="<option value='".$fila["id"]."'>".$fila["localidad"]."</option>";   
    }
    
}else{
    $respuesta="<option></option>";
}


echo $respuesta;
?>