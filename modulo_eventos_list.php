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
                    <h1 class="h2">Eventos</h1>
                    <a href="modulo_eventos_new.php" class="btn btn-primary">Nuevo</a>
                </div>

                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>File Evento</th>
                        <th>Direccion</th>
                        <th>Localidad</th>
                        <th>Provincia</th>
                        <th>Cp</th>
                        <th>Hora Comienzo</th>
                        <th>Acciones</th>
                    </tr>
                    <?php
                    $usuarios = getAllVInner("usuarios", "roles", "id_roles", "id");
                    if (count($usuarios) > 0) {
                        foreach ($usuarios as $u) {
                    ?>
                            <tr>
                                <td><?php echo $u["id1"]; ?></td>
                                <td><?php echo $u["evento"]; ?></td>
                                <td><?php echo $u["fecha"]; ?></td>
                                <td><?php echo $u["file_evento"]; ?></td>
                                <td><?php echo $u["direccion"]; ?></td>
                                <td><?php echo $u["localidad"]; ?></td>
                                <td><?php echo $u["provincia"]; ?></td>
                                <td><?php echo $u["cp"]; ?></td>
                                <td><?php echo $u["hora_comienzo"]; ?></td>
                               
                                <td><a href="modulo_eventos_edit.php?id=<?php echo $u["id1"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="#" data-id="<?php echo $u["id1"]; ?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </table>
            </main>
        </div>
    </div>
    <?php include("scripts.php"); ?>

    <script>
        $(".borrar").click(function(){
            let id=$(this).attr('data-id');
            let padre=$(this).parent().parent();
           const swalWithBootstrapButtons = Swal.mixin({
                          customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                          },
                          buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                          title: "Desea eliminar el role?",
                          text: "no hay vuelta atrás!",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonText: "Si, borrar!",
                          cancelButtonText: "No, mantener!",
                          reverseButtons: true
                        }).then((result) => {
                          if (result.isConfirmed) {
                              
                              $.ajax({
                                     data:{id:id},
                                     method:"POST",
                                     url: "modulo_roles_delete.php", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Rol dado de baja",
                                              icon: "success"
                                            });
                                            padre.hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Rol NO dado de baja",
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

</body>

</html>