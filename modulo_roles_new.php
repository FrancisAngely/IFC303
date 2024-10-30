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
                    <h1 class="h2">Roles - Nuevos</h1>
                    <a href="modulo_roles.php" class="btn btn-primary">Volver</a>
                </div>
                <div class="col-4">
                    <form action="#" method="post" enctype="multipart/form-data" id="form1">
                        
                    <div class="mb-3">
                            <label for="id" class="form-label">Id</label>
                            <span id="id_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="id" name="id" placeholder="id">
                        </div>

                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <span id="usuario_error" class="text-danger"></span>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="usuario" value="<?php echo $user["usuario"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <span id="role_error" class="text-danger"></span>
                            <select class="form-control" id="role" name="role">
                                <option></option>
                                <?php echo SelectOptionsId("roles", "role") ?>

                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="button" class="form-control" value="Aceptar" id="btnform1">
                        </div>
            </main>
        </div>
    </div>
    <?php include("scripts.php"); ?>
    <script>
        $(document).ready(function() {

            $("#btnform1").click(function() {
                // Swal.fire("SweetAlert2 is working!");
                let role = $("#role").val();
                let usuario = $("#usuario").val();
                let error = 0;


                if (role == "") {

                    error = 1;
                    $("#role_error").html("Debe introducir un role");
                    $("#role").addClass("borderError");
                }

                if (usuario == "") {

                    error = 1;
                    $("#usuario_error").html("Debe introducir un nombre de usuario");
                    $("#usuario").addClass("borderError");
                }

                if (error == 0) {
                    $.ajax({
                        data:$("#form1").serialize(), 
                        method: "POST",
                        url: "modulos_usuarios_insert.php",
                        success: function(result) {

                            if (result > 1) {
                                let timerInterval;
                                Swal.fire({
                                    title: "Datos insertados correctamente!",
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

                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        location.href = "modulo_usuarios_List.php";
                                    }
                                });
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