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
          <h1 class="h2">participantes - Editar</h1>
          <a href="modulo_participantes_list.php" class="btn btn-primary">Volver</a>
        </div>

        <?php
        $user = getById("participantes", $_GET["id"]);
        ?>
        <!--SELECT `id`, `id_evento`, `id_entrada`, `nombre`, `apellidos`, `email`, `nif_nie`, `telefono`-->


        <div class="col-4">
          <form action="#" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $user["id"]; ?>">

            <div class="mb-3">
              <label for="id_evento" class="form-label">Eventos</label>
              <span id="id_evento_error" class="text-danger"></span>
              <select class="form-control" id="id_evento" name="id_evento">
                <option></option>
                <?php echo SelectOptionsIdSel("eventos","evento",$part["id_eventos"]);?>

              </select>
            </div>

            <div class="mb-3">
              <label for="id_entrada" class="form-label">participantes</label>
              <span id="id_entrada_error" class="text-danger"></span>
              <select class="form-control" id="id_entrada" name="id_entrada">
                <option></option>
                <?php echo SelectOptionsIdSel("entradas","entrada",$part["id_entradas"]);?>

              </select>
            </div>

            <div class="col-4">
              <form action="#" method="post" enctype="multipart/form-data" id="form1">
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombres</label>
                  <span id="nombre_error" class="text-danger"></span>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres">
                </div>

                <div class="mb-3">
                  <label for="apellidos" class="form-label">apellidos</label>
                  <span id="apellidos_error" class="text-danger"></span>
                  <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <span id="email_error" class="text-danger"></span>
                  <input type="text" class="form-control" id="email" name="email" placeholder="E-mail">
                </div>

                <div class="mb-3">
                  <label for="nif_nie" class="form-label">Nif-Nie</label>
                  <span id="nif_nie_error" class="text-danger"></span>
                  <input type="text" class="form-control" id="nif_nie" name="nif_nie" placeholder="Nif-Nie">
                </div>

                <div class="mb-3">
                  <label for="telefono" class="form-label">Telefono</label>
                  <span id="telefono_error" class="text-danger"></span>
                  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="telefono">
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

        //SELECT `id`, `id_evento`, `id_entrada`, `nombre`, `apellidos`, `email`, `nif_nie`, `telefono`

        let id_eventos = $("#id_eventos").val();
        let id_entrada = $("#id_entrada").val();
        let nombre = $("#nombre").val();
        let apellidos = $("#apellidos").val();
        let email = $("#email").val();
        let nif_nie = $("#nif_nie").val();
        let telefono = $("#telefono").val();
        let error = 0;


        if (id_evento == "") {

          error = 1;
          $("#id_evento_error").html("Debe seleccionar un Evento");
          $("#id_evento").addClass("borderError");
        }

        if (id_entrada == "") {

          error = 1;
          $("#id_entrada_error").html("Debe seleccionar una Entrada");
          $("#id_entrada").addClass("borderError");
        }

        if (nombre == "") {

          error = 1;
          $("#nombre_error").html("Debe introducir un Nombre");
          $("#nombre").addClass("borderError");
        }

        if (apellidos == "") {

          error = 1;
          $("#apellidoserror").html("Debe introducir un apellido");
          $("#apellidos").addClass("borderError");
        }
        if (email == "") {

          error = 1;
          $("#email_error").html("Debe introducir una e-mail");
          $("#email").addClass("borderError");
        }
        if (nif_nie == "") {

          error = 1;
          $("#nif_nie_error").html("Debe introducir un nif o nie");
          $("#nif_nie").addClass("borderError");
        }
        if (telefono == "") {

          error = 1;
          $("#telefono_error").html("Debe introducir un telefono");
          $("#telefono").addClass("borderError");
        }

        if (error == 0) {
          //$("#form1").submit();
          $.ajax({
            data: $("#form1").serialize(),
            method: "POST",
            url: "modulo_participantes_update.php",
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
                    location.href = "modulo_participantes_list.php";
                  }
                });
                //location.href="clientes.php";
              } else {
                Swal.fire("No actualizados correctamente!");

              }
            }
          });
        }

      });




    });
  </script>
</body>

</html>