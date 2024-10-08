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
                    <h1 class="h2">Alta usuario</h1>

                </div>
                <div class="col-4">
                    <form action="#" method="post" enctype="multipart/form-data" id="form1">

                        <div class="mb-3">
                            <label for="username" class="form-label">User</label>
                            <span id="username_error" class="text-danger"></span>
                            <input type="text" class="form-control" name="username" id="username" placeholder="username">
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <span id="pass_error" class="text-danger"></span>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="pass">
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <span id="nombre_error" class="text-danger"></span>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre">
                        </div>

                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <span id="apellidos_error" class="text-danger"></span>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="apellidos">
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <span id="email_error" class="text-danger"></span>
                            <input type="text" class="form-control" name="email" id="email" placeholder="email">
                        </div>

                        <div class="mb-3">
                            <input type="button" class="form-control" value="Aceptar" id="btnform1">
                        </div>

                    </form>
                </div>
                <?php include("scripts.php"); ?>
                <script>
                    $(document).ready(function() {

                        $("#btnform1").click(function() {
                            let username = $("#username").val();
                            let pass = $("#pass").val();
                            let nombre = $("#nombre").val();
                            let apellidos = $("#apellidos").val();
                            let email = $("#email").val();
                            let error = 0;

                            if (username == "") {
                                error = 1;
                                $("#username_error").html("Debe introducir un usuario");
                                $("#username").addClass("borderError");
                            }

                            if (pass == "") {

                                error = 1;
                                $("#pass_error").html("Debe introducir una contraseña");
                                $("#pass").addClass("borderError");
                            }

                            if (nombre == "") {

                                error = 1;
                                $("#nombre_error").html("Debe introducir un nombre");
                                $("#nombre").addClass("borderError");
                            }

                            if (apellidos == "") {

                                error = 1;
                                $("#apellidos_error").html("Debe introducir los apellidos");
                                $("#apellidos").addClass("borderError");
                            }


                            if (email == "") {

                                error = 1;
                                $("#email_error").html("Debe introducir un email");
                                $("#email").addClass("borderError");
                            }

                            if (error == 0) {
                                //$("#form1").submit();
                                $.ajax({
                                    data: {
                                        username:username,
                                        pass:pass,
                                        nombre: nombre,
                                        apellidos: apellidos,
                                        email:email
                                    },
                                    method: "POST",
                                    url: "usuario_insert.php",
                                    success: function(result) {

                                        if (result > 1) {
                                            //alert("Datos insertados correctamente!");
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
                                                /* Read more about handling dismissals below */
                                                if (result.dismiss === Swal.DismissReason.timer) {
                                                    location.href = "usuarios.php";
                                                }
                                            });
                                        } else {
                                            Swal.fire("No Insertado correctamente!");

                                        }
                                    }
                                });
                            }

                        });


                        $("#username").on('keyup', function() {
                            $("#errorV").html("");
                            var value = $(this).val().length;
                            if (value > 0) {
                                $("#username_error").html("");
                                $("#username").removeClass("borderError");
                            } else {
                                $("#username_error").html("Debe introducir un usuario");
                                $("#username").addClass("borderError");
                            }
                        })


                        $("#pass").on('keyup', function() {
                            $("#errorV").html("");
                            var value = $(this).val().length;
                            if (value > 0) {
                                $("#pass_error").html("");
                                $("#pass").removeClass("borderError");
                            } else {
                                $("#pass_error").html("Debe introducir una contraseña");
                                $("#pass").addClass("borderError");
                            }
                        })

                        $("#nombre").on('keyup', function() {
                            $("#errorV").html("");
                            var value = $(this).val().length;
                            if (value > 0) {
                                $("#nombre_error").html("");
                                $("#nombre").removeClass("borderError");
                            } else {
                                $("#nombre_error").html("Debe introducir un nombre de usuario");
                                $("#nombre").addClass("borderError");
                            }
                        })

                        $("#apellidos").on('keyup', function() {
                            $("#errorV").html("");
                            var value = $(this).val().length;
                            if (value > 0) {
                                $("#apellidos_error").html("");
                                $("#apellidos").removeClass("borderError");
                            } else {
                                $("#apellidos_error").html("Debe introducir una apellidos");
                                $("#apellidos").addClass("borderError");
                            }
                        })

                        $("#email").on('keyup', function() {
                            $("#errorV").html("");
                            var value = $(this).val().length;
                            if (value > 0) {
                                $("#email_error").html("");
                                $("#email").removeClass("borderError");
                            } else {
                                $("#email_error").html("Debe introducir un email");
                                $("#email").addClass("borderError");
                            }
                        })

                    });
                </script>


            </main>
        </div>
    </div>
    <?php include("scripts.php"); ?>
</body>

</html>