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
        <h1 class="h2">Usuarios</h1>
          <a href="modulo_usuarios_List_new.php" class="btn btn-primary">Nuevo</a>
      </div>

        <table class="table">
          <tr>
            <th>Id</th>
            <th>Usuario</th>
            <th>E-mail</th>
            <th>Acciones</th>
          </tr>
          <?php
          //$usuarios=getAllV("usuarios"); 
          $usuarios = getAllVInner("usuarios", "roles", "id_roles", "id");
          if (count($usuarios) > 0) {
            foreach ($usuarios as $u) {
          ?>
              <tr>
                <td><?php echo $u["id1"]; ?></td>
                <td><?php echo $u["usuario"]; ?></td>
                <td><?php echo $u["email"]; ?></td>
                
                <td><a href="modulo_usuarios_List_edit.php?id=<?php echo $u["id1"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
            &nbsp;&nbsp;
            <a href="modulos_usuarios_delete.php?id=<?php echo $fila["id1"];?>"><i class="fa-solid fa-trash text-danger"></i></a>
            </td>
              </tr>
          <?php
            }
          }
          ?>
        </table>

        <script>
        $("#btndelete<?php echo $cli["id"];?>").click(function(){
           const swalWithBootstrapButtons = Swal.mixin({
                          customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                          },
                          buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                          title: "Desea eliminar al cliente?",
                          text: "no hay vuelta atrás!",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonText: "Si, borrar!",
                          cancelButtonText: "No, mantener!",
                          reverseButtons: true
                        }).then((result) => {
                          if (result.isConfirmed) {
                              
                              $.ajax({
                                     data:{id:<?php echo $cli["id"];?>},
                                     method:"GET",
                                     url: "clientes_delete.php", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Cliente dado de baja",
                                              icon: "success"
                                            });
                                             $("#fila<?php echo $cli["id"];?>").hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Cliente NO dado de baja",
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



      </main>
    </div>
  </div>
  <?php include("scripts.php"); ?>
</body>

</html>