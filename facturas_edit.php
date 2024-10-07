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
                    <h1 class="h2">Modificar factura</h1>

                </div>
                <div class="col-4">

                    <form action="#" method="post" enctype="multipart/form-data">
                        <?php
                        include("db.php");

                        $sql = "SELECT `id`, `fecha`, `id_clientes`, `created_at`, `updated_at` FROM `facturas` WHERE `id`=" . $_GET["id"];
                        $query = $mysqli->query($sql);
                        if ($query->num_rows > 0) {
                            $fila = $query->fetch_assoc();
                        }
                        ?>

                        <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>" id="id">

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <span id="fecha_error" class="text-danger"></span>
                            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha" value="<?php echo $fila["fecha"]; ?>">
                        </div>


                        <div class="mb-3">
                            <label for="id_clientes" class="form-label">Id Cliente</label>
                            <span id="id_clientes_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="id_clientes" name="id_clientes" placeholder="Id cliente" value="<?php echo $fila["id_clientes"]; ?>">
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

                let id = $("#id").val();
                let fecha = $("#fecha").val();
                let id_clientes = $("#id_clientes").val();
                let error = 0;

                if (fecha == "") {

                    error = 1;
                    $("#fecha_error").html("Debe introducir una fecha");
                    $("#fecha").addClass("borderError");
                }

                if (id_clientes == "") {

                    error = 1;
                    $("#id_clientes_error").html("Debe introducir un i de cliente");
                    $("#id_clientes").addClass("borderError");
                }

                if (error == 0) {
                    //$("#form1").submit();
                    $.ajax({
                        data: {
                            fecha: fecha,
                            id_clientes: id_clientes,
                            id: id
                        },
                        method: "POST",
                        url: "facturas_update.php",
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
                                        location.href = "facturas.php";
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
    </script>
</body>

</html>