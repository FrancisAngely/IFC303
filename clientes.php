<!doctype html>
<html lang="en" data-bs-theme="auto">
  <?php include("head.php");?>
  <body>
    <?php include("iconos.php");?>

<?php include("header.php");?>

<div class="container-fluid">
  <div class="row">
    <?php include("menu.php");?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Clientes</h1>
          <a href="clientes_new.php" class="btn btn-primary">Nuevo</a>
      </div>
    <?php
       include("db.php"); 
     ?>
    <table class="table">
    <tr>
        <th>Id</th> 
        <th>Nombre</th>  
        <th>Apellidos</th>
        <th>Acciones</th>
   </tr>
    <?php
    
    $query=getAll("clientes");    
    if($query->num_rows>0){
        while($fila=$query->fetch_assoc()){
            //var_dump($fila);
          //  echo "<tr><td>".$fila["id"]."</td><td>".$fila["nombre"]."</td><td>".$fila["apellidos"]."</td></tr>";
        ?>
        <tr id="fila<?php echo $fila["id"];?>">
            <td><?php echo $fila["id"];?></td>
            <td><?php echo $fila["nombre"];?></td>
            <td><?php echo $fila["apellidos"];?></td>
            <td><a href="clientes_edit.php?id=<?php echo $fila["id"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
            &nbsp;&nbsp;
            <a href="#" id="btndelete<?php echo $fila["id"];?>"><i class="fa-solid fa-trash text-danger"></i></a>
            </td>
        </tr>
        <!--clientes_delete.php?id=<?php echo $fila["id"];?>-->
        <script>
        $("#btndelete<?php echo $fila["id"];?>").click(function(){
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
                                     data:{id:<?php echo $fila["id"];?>},
                                     method:"GET",
                                     url: "clientes_delete.php", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Cliente dado de baja",
                                              icon: "success"
                                            });
                                             $("#fila<?php echo $fila["id"];?>").hide();
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
        
        
        <?php
        }
    }    
    ?>
        
    </table>
        
    <hr>
         <table class="table">
    <tr>
        <th>Id</th> 
        <th>Nombre</th>  
        <th>Apellidos</th>
        <th>Acciones</th>
   </tr>
    <?php
       $misClientes=TodosClientesV();  
    if(count($misClientes)>0){
        foreach($misClientes as $cli){
            ?>
        <tr id="fila<?php echo $cli["id"];?>">
            <td><?php echo $cli["id"];?></td>
            <td><?php echo $cli["nombre"];?></td>
            <td><?php echo $cli["apellidos"];?></td>
            <td><a href="clientes_edit.php?id=<?php echo $cli["id"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
            &nbsp;&nbsp;
            <a href="#" id="btndelete<?php echo $cli["id"];?>"><i class="fa-solid fa-trash text-danger"></i></a>
            </td>
        </tr>
        <!--clientes_delete.php?id=<?php echo $cli["id"];?>-->
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
        <?php
        }
        
    }
    ?>
      </table>  
        
        
    <hr>

      
    </main>
  </div>
</div>
 <?php include("scripts.php");?>     
</body>
</html>