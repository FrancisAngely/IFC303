<?php
function TodosClientes()
{
    include("db.php");

    $sql = "SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes` WHERE 1";

    $query = $mysqli->query($sql);
    return $query;
}


function TodosClientesV()
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes` WHERE 1";

    $query = $mysqli->query($sql);

    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}


function EliminarCliente($id)
{
    include("db.php");
    $sql = "DELETE FROM `clientes` WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}

function InsertarCliente($post)
{

    $nombre = $post["nombre"];
    $apellidos = $post["apellidos"];
    include("db.php");
    $sql = "INSERT INTO `clientes`(`id`, `nombre`, `apellidos`, `created_at`, `updated_at`) VALUES (";
    $sql .= "'NULL'";
    $sql .= ",'" . $nombre . "'";
    $sql .= ",'" . $apellidos . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

function ActualizarCliente($post)
{
    $id = $post["id"];
    $nombre = $post["nombre"];
    $apellidos = $post["apellidos"];

    include("db.php");
    $sql = "UPDATE `clientes` SET `nombre`='" . $nombre . "',`apellidos`='" . $apellidos . "',`updated_at`='" . date("Y-m-d h:i:s") . "' WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}

function TodosProveedores()
{
    include("db.php");

    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";
    $query = $mysqli->query($sql);
    return $query;
}

function TodosProveedoresV()
{
    include("db.php");
    $resultado1 = array();
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

    $query = $mysqli->query($sql);

    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado1, $fila);
        }
    }
    return $resultado1;
}

function EliminarProveedor($id)
{
    include("db.php");
    $sql = "DELETE FROM `proveedores` WHERE `id`='" . $id . "'";

    if ($mysqli->query($sql)) return 1;
    else return 0;
}

function InsertarProveedor($post)
{
    $razon_social = $post["razon_social"];
    $nombre_comercial = $post["nombre_comercial"];
    $cif = $post["cif"];
    $formapago = $post["formapago"];
    include("db.php");
    $sql = "INSERT INTO `proveedores`(`id`, `razon_social`, `nombre_comercial`,`cif`,`formapago`, `created_at`, `updated_at`) VALUES (";
    $sql .= "'NULL'";
    $sql .= ",'" . $razon_social . "'";
    $sql .= ",'" . $nombre_comercial . "'";
    $sql .= ",'" . $cif . "'";
    $sql .= ",'" . $formapago . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

function ActualizarProveedor($post)
{
    $id = $post["id"];
    $razon_social = $post["razon_social"];
    $nombre_comercial = $post["nombre_comercial"];
    $cif = $post["cif"];
    $formapago = $post["formapago"];

    include("db.php");
    $sql = "UPDATE `proveedores` SET `razon_social`='" . $razon_social . "',`nombre_comercial`='" . $nombre_comercial . "',`cif`='" . $cif . "',`formapago`='" . $formapago . "',`updated_at`='" . date("Y-m-d h:i:s") . "' WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}

function DatosProveedor($post)
{
    include("db.php");
    $fila = array();
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE `id`=" . $_GET["id"];
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        $fila = $query->fetch_assoc();
    }
    return $fila;
}

