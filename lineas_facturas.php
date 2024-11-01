<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php include("head.php"); ?>

<body>
    <?php include("iconos.php"); ?>

    <?php include("header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include("menu.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Facturas</h1>

                    <a href="lineas_facturas_new.php" class="btn btn-primary">Nuevo</a>
                </div>
                <?php
                include("db.php");
                ?>
                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Id Facturas</th>
                        <th>Id Productos</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Base</th>
                        <th>Descuento</th>
                        <th>Iva</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                    <?php
                    $sql = "SELECT 
                    `lineas_facturas`.`id`, 
                    `lineas_facturas`.`id_facturas`, 
                    `lineas_facturas`.`id_productos`, 
                    `lineas_facturas`.`cantidad`, 
                    `lineas_facturas`.`precio_unitario`,
                    `lineas_facturas`.`base`, 
                    `lineas_facturas`.`descuento`, 
                    `lineas_facturas`.`iva`, 
                    `lineas_facturas`.`precio`, 
                    `lineas_facturas`.`created_at`, 
                    `lineas_facturas`.`updated_at`,
                    facturas.fecha,CONCAT(clientes.nombre,clientes.apellidos) AS 
                    cli,productos.`producto`, productos.`imagen`, 
                    productos.`precio` as p1, productos.`iva` as iva1, productos.`stock` FROM `lineas_facturas` ";

                    $sql .= " LEFT JOIN facturas ON `lineas_facturas`.`id_facturas`=facturas.id";

                    $sql .= " LEFT JOIN clientes ON `facturas`.id_clientes=clientes.id";

                    $sql .= " LEFT JOIN productos ON `lineas_facturas`.`id_productos`=productos.id";

                    $query = $mysqli->query($sql);
                    if ($query->num_rows > 0) {
                        while ($fila = $query->fetch_assoc()) {
                            //var_dump($fila);
                            //  echo "<tr><td>".$fila["id"]."</td><td>".$fila["nombre"]."</td><td>".$fila["apellidos"]."</td></tr>";
                    ?>
                            <tr id="fila<?php echo $fila["id"]; ?>">
                                <td><?php echo $fila["id"]; ?></td>
                                <td><?php echo $fila["id_facturas"]; ?></td>
                                <td><?php echo $fila["id_productos"]; ?></td>
                                <td><?php echo $fila["cantidad"]; ?></td>
                                <td><?php echo $fila["precio_unitario"]; ?></td>
                                <td><?php echo $fila["base"]; ?></td>
                                <td><?php echo $fila["descuento"]; ?></td>
                                <td><?php echo $fila["iva"]; ?></td>
                                <td><?php echo $fila["precio"]; ?></td>
                                <td><a href="lineas_facturas_edit.php?id=<?php echo $fila["id"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="#" id="btndelete<?php echo $fila["id"]; ?>"><i class="fa-solid fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                            <script>
                                $("#btndelete<?php echo $fila["id"]; ?>").click(function() {
                                    const swalWithBootstrapButtons = Swal.mixin({
                                        customClass: {
                                            confirmButton: "btn btn-success",
                                            cancelButton: "btn btn-danger"
                                        },
                                        buttonsStyling: false
                                    });
                                    swalWithBootstrapButtons.fire({
                                        title: "Desea eliminar la factura?",
                                        text: "no hay vuelta atrás!",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonText: "Si, borrar!",
                                        cancelButtonText: "No, mantener!",
                                        reverseButtons: true
                                    }).then((result) => {
                                        if (result.isConfirmed) {

                                            $.ajax({
                                                data: {
                                                    id: <?php echo $fila["id"]; ?>
                                                },
                                                method: "GET",
                                                url: "lineas_facturas_delete.php",
                                                success: function(result) {
                                                    if (result == 1) {
                                                        swalWithBootstrapButtons.fire({
                                                            title: "Eliminado!",
                                                            text: "Factura dada de baja",
                                                            icon: "success"
                                                        });
                                                        $("#fila<?php echo $fila["id"]; ?>").hide();
                                                    } else {
                                                        swalWithBootstrapButtons.fire({
                                                            title: "No Eliminado!",
                                                            text: "Factura NO dada de baja",
                                                            icon: "error"
                                                        });
                                                    }
                                                }
                                            });

                                        } else if (
                                            /* Read more about handling dismissals below */
                                            result.dismiss === Swal.DismissReason.cancel
                                        ) {}
                                    });
                                });
                            </script>
                    <?php
                        }
                    }
                    ?>

                </table>
            </main>
        </div>
    </div>
    <?php include("scripts.php"); ?>
</body>

</html>