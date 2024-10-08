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
          <h1 class="h2">Alta linea facturas</h1>

        </div>
        <div class="col-4">

          <form action="#" method="post" enctype="multipart/form-data">
            <div class="mb-3">

              <label for="id_facturas" class="form-label">Id factura</label>
              <span id="id_facturas_error" class="text-danger"></span>


              <select class="form-control select2" id="id_facturas" name="id_facturas">
                <option></option>
                <?php
                include("db.php");
                $sqlFact = "SELECT `id`, `fecha`, `id_clientes`, `created_at`, `updated_at` FROM `facturas` WHERE 1";
                $resultFact = $mysqli->query($sqlFact);
                if ($resultFact->num_rows > 0) {
                  while ($filaFact = $resultFact->fetch_assoc()) {
                ?>
                    <option value="<?php echo $filaFact["id"]; ?>"><?php echo $filaFact["id"]; ?>-<?php echo $filaFact["fecha"]; ?></option>
                <?php
                  }
                }
                ?>

              </select>
            </div>


            <div class="mb-3">
              <label for="id_productos" class="form-label">Id producto</label>
              <span id="id_productos_error" class="text-danger"></span>

              <select class="form-control select2" id="id_productos" name="id_productos">
                <option></option>
                <?php

                $sqlProd = "SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1";
                $resultProd = $mysqli->query($sqlProd);
                if ($resultProd->num_rows > 0) {
                  while ($filaProd = $resultProd->fetch_assoc()) {
                ?>
                    <option value="<?php echo $filaProd["id"]; ?>"><?php echo $filaProd["producto"]; ?></option>
                <?php
                  }
                }
                ?>

              </select>
            </div>

            <div class="mb-3">
              <label for="cantidad" class="form-label">Cantidad</label>
              <span id="cantidad_error" class="text-danger"></span>
              <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad">
            </div>

            <div class="mb-3">
              <label for="precio_unitario" class="form-label">Precio Unitario</label>
              <span id="precio_unitario_error" class="text-danger"></span>
              <input type="text" class="form-control" id="precio_unitario" name="precio_unitario" placeholder="precio unitario">
            </div>

            <div class="mb-3">
              <label for="base" class="form-label">Base</label>
              <span id="base_error" class="text-danger"></span>
              <input type="text" class="form-control" id="base" name="base" placeholder="base">
            </div>

            <div class="mb-3">
              <label for="descuento" class="form-label">Descuento</label>
              <span id="descuento_error" class="text-danger"></span>
              <input type="text" class="form-control" id="descuento" name="descuento" placeholder="descuento">
            </div>

            <div class="mb-3">
              <label for="iva" class="form-label">IVA</label>
              <span id="iva_error" class="text-danger"></span>
              <input type="text" class="form-control" id="iva" name="iva" placeholder="iva">
            </div>

            <div class="mb-3">
              <label for="precio" class="form-label">Precio</label>
              <span id="precio_error" class="text-danger"></span>
              <input type="text" class="form-control" id="precio" name="precio" placeholder="precio">
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
          //$("#form1").submit();
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
            url: "lineas_facturas_insert.php",
            success: function(result) {
              alert(result);
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
                    location.href = "lineas_facturas.php";
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

    $("#id_productos").change(function(){
       //alert("buscar precio");
           
    });


  </script>
</body>

</html>