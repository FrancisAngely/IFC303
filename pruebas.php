<?php

$datos["id"]="NULL";
$datos["razon_social"]="a";
$datos["nombre_comercial"]="e";
$datos["cif"]="123";
$datos["formapago"]="contado";
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');


foreach($datos as $k=>$v){
    echo $k;echo "<br>";
}

foreach($datos as $k=>$v){
    echo $v;echo "<br>";
}
?>