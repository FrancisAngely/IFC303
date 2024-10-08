<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php include("head.php"); ?>

<body>
    <?php include("iconos.php"); ?>

    <?php include("header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include("menu.php"); ?>
            <?php
            include("db.php");
            $sql = "SELECT `id`, `username`, `pass`, `nombre`, `apellidos`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE `id`=" . $_GET["id"];
            $query = $mysqli->query($sql);
            if ($query->num_rows > 0) {
                $fila = $query->fetch_assoc();
            }
            ?>


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Editar</h1>

                </div>
                <div class="col-4">
                    <form action="usuario_update.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">


                        <div class="mb-3">
                            <label for="username" class="form-label">User</label>
                            <input type="text" class="form-control" name="username" name="username" placeholder="username" value="<?php echo $fila["username"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="pass" value="<?php echo $fila["pass"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" name="nombre" placeholder="nombre" value="<?php echo $fila["nombre"]; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" name="apellidos" placeholder="apellidos" value="<?php echo $fila["apellidos"]; ?>">
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" name="email" placeholder="email" value="<?php echo $fila["email"]; ?>">
                        </div>

                        <div class="mb-3">
                            <input type="submit" class="form-control" value="Aceptar">
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
                    $("#form1").submit();
                    $.ajax({
                        data: {
                            username: username,
                            pass: pass,
                            nombre: nombre,
                            apellidos: apellidos,
                            email: email
                        },
                        method: "POST",
                        url: "verificar.php",
                        success: function(result) {
                            if (result == 0) {
                                $("#errorV").html("usuario o contraseña incorrectos");

                                $("#username").val('');
                                $("#pass").val('');
                                $("#nombre").val('');
                                $("#apellidos").val('');
                                $("#email").val('');
                            } else {
                                location.href = "usuario.php";
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

</body>

</html>