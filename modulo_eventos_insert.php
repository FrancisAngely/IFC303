<?php
include("controller.php");
$tabla="eventos";

$datos["evento"]=$_POST["evento"];
$datos["fecha"]=$_POST["fecha"];
$datos["file_evento"]=$_POST["file_evento"];
$datos["direccion"]=$_POST["direccion"];
$datos["localidad"]=$_POST["localidad"];
$datos["provincia"]=$_POST["provincia"];
$datos["cp"]=$_POST["cp"];
$datos["hora_comienzo"]=$_POST["hora_comienzo"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');

echo saveV($tabla,$datos);


?>