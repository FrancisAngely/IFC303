<!doctype html>
<html lang="en" data-bs-theme="auto">
  <?php include("head.php");?>
  <body>
    <?php include("iconos.php");?>

<?php include("header.php");?>

<div class="container-fluid">
  <div class="row">
    <?php include("menu.php");?>
<?php
 include("db.php");
$sql="SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes` WHERE `id`=".$_GET["id"];
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        $fila=$query->fetch_assoc();
    
    }
?>
      
      
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar cliente</h1>
         
      </div>
<div class="col-4">
    <form action="clientes_update.php" method="post" enctype="multipart/form-data" id="form1">
<input type="hidden" name="id" value="<?php echo $fila["id"];?>" id="id">
       
<div class="mb-3">
  <label for="nombre" class="form-label">Nombre</label>
    <span id="nombre_error" class="text-danger"></span>
  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="<?php echo $fila["nombre"];?>">
</div>

    
<div class="mb-3">
  <label for="apellidos" class="form-label">Apellidos</label>
    <span id="apellidos_error" class="text-danger"></span>
  <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="apellidos" value="<?php echo $fila["apellidos"];?>">
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
           let nombre=$("#nombre").val();  
           let apellidos=$("#apellidos").val();
          let id=$("#id").val();
            let error=0;
          
           if(nombre==""){
               
               error=1;
               $("#nombre_error").html("Debe introducir un nombre");
                $("#nombre").addClass("borderError");
           }
        
           if(apellidos==""){
               
               error=1;
               $("#apellidos_error").html("Debe introducir los apellidos");
               $("#apellidos").addClass("borderError");
           }
        if(error==0){
            //$("#form1").submit();
           $.ajax({
                 data:{id:id,nombre:nombre,apellidos:apellidos},
                 method:"POST",
                 url: "clientes_update.php", 
                 success: function(result){
                    
                     if(result==1){
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
                                location.href="clientes.php";
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
    
       
     $("#nombre").on('keyup', function(){
         $("#errorV").html("");
        var value = $(this).val().length;
        if(value>0){
            $("#nombre_error").html("");
            $("#nombre").removeClass("borderError");
        }else{
           $("#nombre_error").html("Debe introducir un nombre de usuario");
           $("#nombre").addClass("borderError"); 
        }
    })
    
    $("#apellidos").on('keyup', function(){
        $("#errorV").html("");
        var value = $(this).val().length;
        if(value>0){
            $("#apellidos_error").html("");
            $("#apellidos").removeClass("borderError");
        }else{
           $("#apellidos_error").html("Debe introducir una apellidos");
           $("#apellidos").addClass("borderError"); 
        }
    })
    
});      
      
</script>
</body>
</html>