<?php

include("controller.php");
$tabla="participantes";

//`id`, `id_evento`, `id_entrada`, `nombre`, `apellidos`, `email`, `nif_nie`, `telefono`,

$datos["id_evento"]=$_POST["id_evento"];
$datos["id_entrada"]=$_POST["id_entrada"];
$datos["nombre"]=$_POST["nombre"];
$datos["apellidos"]=$_POST["apellidos"];
$datos["email"]=$_POST["email"];
$datos["nif_nie"]=$_POST["nif_nie"];
$datos["telefono"]=$_POST["telefono"];
$datos["created_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');
$datos["updated_at"]=date('Y-m-d h:i:s');

echo saveV($tabla,$datos);

?>