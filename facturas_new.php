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
        <h1 class="h2">Alta factura</h1>
         
      </div>
<div class="col-4">
     
    <form action="#" method="post" enctype="multipart/form-data">
<div class="mb-3">

  <label for="fecha" class="form-label">Fecha</label>
     <span id="fecha_error" class="text-danger"></span>
  <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha">
</div>

    
<div class="mb-3">
  <label for="id_clientes" class="form-label">Id Clientes</label>
     <span id="id_clientes_error" class="text-danger"></span>
  <input type="text" class="form-control" id="id_clientes" name="id_clientes" placeholder="id_cliente">
</div>        
    
<div class="mb-3"> 
  <input type="button" class="form-control" value="Aceptar" id="btnform1">
</div>
    
    </form>
 </div>         
  
    </main>
  </div>
</div>
 <?php include("scripts.php");?>     
      
      <script>
$( document ).ready(function() {
   
    $("#btnform1").click(function(){
       // Swal.fire("SweetAlert2 is working!");
        
 
            let fecha=$("#fecha").val();  
            let id_clientes=$("#id_clientes").val();
            let error=0;
          
           if(fecha==""){
               
               error=1;
               $("#fecha_error").html("Debe introducir una fecha");
                $("#fecha").addClass("borderError");
           }
        
           if(id_clientes==""){
               
               error=1;
               $("#id_clientes_error").html("Debe introducir un id cliente");
               $("#id_clientes").addClass("borderError");
           }
        
        if(error==0){
            //$("#form1").submit();
             $.ajax({
                 data:{fecha:fecha,id_clientes:id_clientes},
                 method:"POST",
                 url: "facturas_insert.php", 
                 success: function(result){
                    
                     if(result>1){
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
                                location.href="facturas.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
                          Swal.fire("No Insertado correctamente!");
                        
                     }
                }
             });
        }
         
    });  
});     

$("#fecha").on('keyup', function(){
         $("#errorV").html("");
        var value = $(this).val().length;
        if(value>0){
            $("#fecha_error").html("");
            $("#fecha").removeClass("borderError");
        }else{
           $("#fecha_error").html("Debe introducir una fecha");
           $("#fecha").addClass("borderError"); 
        }
    })
    
    $("#id_clientes").on('keyup', function(){
        $("#errorV").html("");
        var value = $(this).val().length;
        if(value>0){
            $("#id_clientes_error").html("");
            $("#id_clientes").removeClass("borderError");
        }else{
           $("#id_clientes_error").html("Debe introducir un id");
           $("#id_clientes").addClass("borderError"); 
        }
    })
    
</script>
</body>
</html>