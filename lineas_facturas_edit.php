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
                    <h1 class="h2">Modificar linea factura</h1>

                </div>
                <div class="col-4">

                    <form action="#" method="post" enctype="multipart/form-data">
                        <?php
                        include("db.php");

                        $sql = "SELECT `id`, `id_facturas`, `id_productos`, `cantidad`, `precio_unitario`, `base`, `descuento`, `iva`, `precio`, `created_at`, `updated_at` FROM `lineas_facturas` WHERE `id`=" . $_GET["id"];
                        $query = $mysqli->query($sql);
                        if ($query->num_rows > 0) {
                            $fila = $query->fetch_assoc();
                        }
                        ?>

                        <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>" id="id">

                        <div class="mb-3">
                            <label for="id_facturas" class="form-label">id_facturas</label>
                            <span id="id_facturas_error" class="text-danger"></span>
                            <input type="id_facturas" class="form-control" id="id_facturas" name="id_facturas" placeholder="id_facturas" value="<?php echo $fila["id_facturas"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="id_productos" class="form-label">Id productos</label>
                            <span id="id_productos_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="id_productos" name="id_productos" placeholder="id_productos" value="<?php echo $fila["id_productos"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <span id="cantidad_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad" value="<?php echo $fila["cantidad"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="precio_unitario" class="form-label">Precio_unitario</label>
                            <span id="precio_unitario_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="precio_unitario" value="<?php echo $fila["precio_unitario"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="base" class="form-label">Base</label>
                            <span id="base_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="base" name="base" placeholder="base" value="<?php echo $fila["base"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="descuento" class="form-label">Descuento</label>
                            <span id="descuento_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="descuento" name="descuento" placeholder="descuento" value="<?php echo $fila["descuento"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="iva" class="form-label">IVA</label>
                            <span id="iva_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="iva" name="iva" placeholder="iva" value="<?php echo $fila["iva"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <span id="precio_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="precio" name="precio" placeholder="precio" value="<?php echo $fila["precio"]; ?>">
                        </div>

                        <div class="mb-3">
                            <input type="button" class="form-control" value="Aceptar" id="btnform1">
                        </div>

                    </form>
                </div>



            </main>
        </div>
    </div>
    <?php include("scripts.php"); ?>
    <script>
        $(document).ready(function() {

            $("#btnform1").click(function() {
                // Swal.fire("SweetAlert2 is working!");
                let id_facturas = $("#id_facturas").val();
                let id_productos = $("#id_productos").val();
                let cantidad = $("#cantidad").val();
                let precio_unitario = $("#precio_unitario").val();
                let base = $("#base").val();
                let descuento = $("#descuento").val();
                let iva = $("#iva").val();
                let precio = $("#precio").val();
                let error = 0;

                if (id_facturas == "") {
                    error = 1;
                    $("#id_facturas_error").html("Debe introducir un id");
                    $("#id_facturas").addClass("borderError");
                }

                if (id_productos == "") {
                    error = 1;
                    $("#id_productos_error").html("Debe introducir un id producto");
                    $("#id_productos").addClass("borderError");
                }

                if (cantidad == "") {
                    error = 1;
                    $("#cantidad_error").html("Debe introducir una cantidad");
                    $("#cantidad").addClass("borderError");
                }

                if (precio_unitario == "") {
                    error = 1;
                    $("#precio_unitario_error").html("Debe introducir un precio unitario");
                    $("#precio_unitario").addClass("borderError");
                }

                if (base == "") {
                    error = 1;
                    $("#base_error").html("Debe introducir una base");
                    $("#base").addClass("borderError");
                }

                if (descuento == "") {
                    error = 1;
                    $("#descuento_error").html("Debe introducir un descuento");
                    $("#descuento").addClass("borderError");
                }

                if (iva == "") {
                    error = 1;
                    $("#iva_error").html("Debe introducir un iva");
                    $("#iva").addClass("borderError");
                }

                if (precio == "") {
                    error = 1;
                    $("#precio_error").html("Debe introducir un precio");
                    $("#precio").addClass("borderError");
                }

                if (error == 0) {
                    $.ajax({
                        data: {
                            id_facturas: id_facturas,
                            id_productos: id_productos,
                            cantidad: cantidad,
                            precio_unitario: precio_unitario,
                            base: base,
                            descuento: descuento,
                            iva: iva,
                            precio: precio
                        },
                        method: "POST",
                        url: "lineas_facturas_update.php",
                        success: function(result) {

                            if (result == 1) {
                                //alert("Datos insertados correctamente!");
                                let timerInterval;
                                Swal.fire({
                                    title: "Datos actualizados correctamente!",
                                    html: "",
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading();
                                        const timer = Swal.getPopup().querySelector("b");
                                        timerInterval = setInterval(() => {
                                            timer.textContent = `${Swal.getTimerLeft()}`;
                                        }, 100);
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval);
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        location.href = "lineas_facturas.php";
                                    }
                                });
                                //location.href="facturas.php";
                            } else {
                                Swal.fire("No Insertado correctamente!");

                            }
                        }
                    });
                }

            });
        });

        $("#id_facturas").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#id_facturas_error").html("");
                $("#id_facturas").removeClass("borderError");
            } else {
                $("#id_facturas_error").html("Debe introducir un id");
                $("#id_facturas").addClass("borderError");
            }
        })

        $("#id_productos").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#id_productos_error").html("");
                $("#id_productos").removeClass("borderError");
            } else {
                $("#id_productos_error").html("Debe introducir un id");
                $("#id_productos").addClass("borderError");
            }
        })

        $("#cantidad").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#cantidad_error").html("");
                $("#cantidad").removeClass("borderError");
            } else {
                $("#cantidad_error").html("Debe introducir una cantidad de producto");
                $("#cantidad").addClass("borderError");
            }
        })


        $("#precio_unitario").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#precio_unitario_error").html("");
                $("#precio_unitario").removeClass("borderError");
            } else {
                $("#iprecio_unitario_error").html("Debe introducir un precio unitario");
                $("#precio_unitario").addClass("borderError");
            }
        })

        $("#base").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#base_error").html("");
                $("#base").removeClass("borderError");
            } else {
                $("#base_error").html("Debe introducir una base");
                $("#base").addClass("borderError");
            }
        })

        $("#descuento").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#descuento_error").html("");
                $("#descuento").removeClass("borderError");
            } else {
                $("#descuento_error").html("Debe introducir un descuento");
                $("#descuento").addClass("borderError");
            }
        })

        $("#iva").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#iva_error").html("");
                $("#iva").removeClass("borderError");
            } else {
                $("#iva_error").html("Debe introducir un iva");
                $("#iva").addClass("borderError");
            }
        })

        $("#precio").on('keyup', function() {
            $("#errorV").html("");
            var value = $(this).val().length;
            if (value > 0) {
                $("#precio_error").html("");
                $("#precio").removeClass("borderError");
            } else {
                $("#precio_error").html("Debe introducir un precio");
                $("#precio").addClass("borderError");
            }
        })
    </script>
</body>

</html>