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
          <h1 class="h2">Proveedores</h1>
          <a href="proveedores_new.php" class="btn btn-primary">Nuevo</a>
        </div>
        <?php
        include("db.php");
        ?>
        <table class="table">
          <tr>
            <th>Id</th>
            <th>Razon Social</th>
            <th>Nombre comercial</th>
            <th>Cif</th>
            <th>Acciones</th>
          </tr>

          <?php
          //$sql="SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

          $query = TodosProveedores();
          if ($query->num_rows > 0) {
            while ($fila = $query->fetch_assoc()) {
              //var_dump($fila);
              //  echo "<tr><td>".$fila["id"]."</td><td>".$fila["nombre"]."</td><td>".$fila["apellidos"]."</td></tr>";
          ?>
              <tr id="fila<?php echo $fila["id"]; ?>">
                <td><?php echo $fila["id"]; ?></td>
                <td><?php echo $fila["razon_social"]; ?></td>
                <td><?php echo $fila["nombre_comercial"]; ?></td>
                <td><?php echo $fila["cif"]; ?></td>
                <td><a href="proveedores_edit.php?id=<?php echo $fila["id"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
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
                    title: "Desea eliminar al proveedor?",
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
                        url: "proveedores_delete.php",
                        success: function(result) {
                          if (result == 1) {
                            swalWithBootstrapButtons.fire({
                              title: "Eliminado!",
                              text: "Proveedor dado de baja",
                              icon: "success"
                            });
                            $("#fila<?php echo $fila["id"]; ?>").hide();
                          } else {
                            swalWithBootstrapButtons.fire({
                              title: "No Eliminado!",
                              text: "Proveedor NO dado de baja",
                              icon: "error"
                            });
                          }
                        }
                      });





                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      /*   swalWithBootstrapButtons.fire({
                           title: "Cancelled",
                           text: "Your imaginary file is safe :)",
                           icon: "error"
                         });*/
                    }
                  });
                });
              </script>
          <?php
            }
          }
          ?>

        </table>
        <hr>

        <table class="table">
          <tr>
            <th>Id</th>
            <th>Razon Social</th>
            <th>Nombre comercial</th>
            <th>Cif</th>
            <th>Acciones</th>
          </tr>
          <?php
          $misproveedores = TodosProveedoresV();
          if (count($misproveedores) > 0) {
            foreach ($misproveedores as $cli) {
          ?>
              <tr id="fila3<?php echo $cli["id"]; ?>">
                <td><?php echo $cli["id"]; ?></td>
                <td><?php echo $cli["razon_social"]; ?></td>
                <td><?php echo $cli["nombre_comercial"]; ?></td>
                <td><?php echo $cli["cif"]; ?></td>
                <td><a href="proveedores_edit.php?id=<?php echo $cli["id"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                  &nbsp;&nbsp;
                  <a href="#" id="btndelete3<?php echo $cli["id"]; ?>"><i class="fa-solid fa-trash text-danger"></i></a>
                </td>
              </tr>
              <script>
                $("#btndelete3<?php echo $cli["id"]; ?>").click(function() {
                  const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                      confirmButton: "btn btn-success",
                      cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                  });
                  swalWithBootstrapButtons.fire({
                    title: "Desea eliminar al proveedor?",
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
                          id: <?php echo $cli["id"]; ?>
                        },
                        method: "GET",
                        url: "proveedores_delete.php",
                        success: function(result) {
                          if (result == 1) {
                            swalWithBootstrapButtons.fire({
                              title: "Eliminado!",
                              text: "Proveedor dado de baja",
                              icon: "success"
                            });
                            $("#fila3<?php echo $cli["id"]; ?>").hide();
                          } else {
                            swalWithBootstrapButtons.fire({
                              title: "No Eliminado!",
                              text: "Proveedor NO dado de baja",
                              icon: "error"
                            });
                          }
                        }
                      });
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      /*   swalWithBootstrapButtons.fire({
                           title: "Cancelled",
                           text: "Your imaginary file is safe :)",
                           icon: "error"
                         });*/
                    }
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