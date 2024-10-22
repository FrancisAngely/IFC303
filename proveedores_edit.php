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
          <h1 class="h2">Modificar proveedor</h1>

        </div>
        <div class="col-4">

          <form action="#" method="post" enctype="multipart/form-data">
            <?php


            $fila = DatosProveedor($_GET["id"]);

            /*include("db.php");
            $sql="SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE `id`=".$_GET["id"];
            $query=$mysqli->query($sql);    
            if($query->num_rows>0){
            $fila=$query->fetch_assoc();
            }*/

            ?>
            <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>" id="id">

            <div class="mb-3">
              <label for="razon_social" class="form-label">Razon social</label>
              <span id="razon_social_error" class="text-danger"></span>
              <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Razon_social" value="<?php echo $fila["razon_social"]; ?>">
            </div>


            <div class="mb-3">
              <label for="nombre_comercial" class="form-label">Nombre comercial</label>
              <span id="nombre_comercial_error" class="text-danger"></span>
              <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" placeholder="Nombre comercial" value="<?php echo $fila["nombre_comercial"]; ?>">
            </div>



            <div class="mb-3">
              <label for="cif" class="form-label">Cif</label>
              <span id="cif_error" class="text-danger"></span>
              <input type="text" class="form-control" id="cif" name="cif" placeholder="Cif" value="<?php echo $fila["cif"]; ?>">
            </div>

            <div class="mb-3">
              <label for="formapago" class="form-label">Forma de pago</label>
              <span id="formapago_error" class="text-danger"></span>
              <input type="text" class="form-control" id="formapago" name="formapago" placeholder="Forma de pago" value="<?php echo $fila["formapago"]; ?>">
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
        let razon_social = $("#razon_social").val();
        let nombre_comercial = $("#nombre_comercial").val();
        let cif = $("#cif").val();
        let formapago = $("#formapago").val();

        let error = 0;

        if (razon_social == "") {

          error = 1;
          $("#razon_social_error").html("Debe introducir una razon social");
          $("#razon_social").addClass("borderError");
        }

        if (nombre_comercial == "") {

          error = 1;
          $("#nombre_comercial_error").html("Debe introducir un nombre comercial");
          $("#nombre_comercial").addClass("borderError");
        }

        if (cif == "") {

          error = 1;
          $("#cif_error").html("Debe introducir un cif valido");
          $("#cif").addClass("borderError");
        }

        if (formapago == "") {

          error = 1;
          $("#formapago_error").html("Debe introducir una forma de pago");
          $("#formapago").addClass("borderError");
        }
        if (error == 0) {
          //$("#form1").submit();
          $.ajax({
            data: {
              razon_social: razon_social,
              nombre_comercial: nombre_comercial,
              cif: cif,
              formapago: formapago,
              id: id
            },
            method: "POST",
            url: "proveedores_update.php",
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
                    location.href = "proveedores.php";
                  }
                });
                //location.href="clientes.php";
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