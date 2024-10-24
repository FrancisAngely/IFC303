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
        <h1 class="h2">Alta dirección proveedor</h1>
         
      </div>
<div class="col-4">
     
    <form action="#" method="post" enctype="multipart/form-data">
        
<?php include("db.php");?>

<div class="mb-3">
  <label for="id_proveedor" class="form-label">Proveedor</label>
  <select class="form-control" id="id_proveedor" name="id_proveedor">
  <option></option>
  <?php
    // echo SelectOptionsIdOrderBy("proveedores","razon_social","ASC");
    //echo SelectOptions2CamposOrderBy("proveedores","id","razon_social","cif","-","ASC");
      
      $Vmostrar="razon_social,nombre_comercial,cif";
    echo SelectOptionsVariosCamposOrderBy("proveedores","id",$Vmostrar,"-","ASC");
    ?>
 </select>
</div>
        
        
        
<div class="mb-3">
  <label for="direccion" class="form-label">Dirección</label>
  <input type="text" class="form-control" id="direccion" name="direccion" placeholder="dirección">
</div>
<div class="mb-3">
  <label for="provincia" class="form-label">provincia</label>
    <select class="form-control select2" id="provincia" name="provincia" >
      <option></option>
        <?php
         //SelectProvincias();
        echo SelectOptionsOrderBy("provincias","id","provincia","DESC");
        ?>
        
    </select>
</div>
    
<div class="mb-3">
  <label for="localidad" class="form-label">Localidad</label>
  <select class="form-control select2" id="localidad" name="localidad">
    <option></option>
    </select>
</div>
        
      
   


<div class="mb-3">
  <label for="cp" class="form-label">CP</label>
  <input type="text" class="form-control" id="cp" name="cp" placeholder="cp">
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
       $(".select2").select2({theme: "classic"});
       
       $("#provincia").change(function(){
           let provincia= $("#provincia").val();
            $.ajax({
                 data:{provincia:provincia},
                 method:"POST",
                 url: "localidades_provincia.php", 
                 success: function(result){
                    $("#localidad").html(result);
                     
                }
             });
       });
       
       $("#btnform1").click(function(){
       // Swal.fire("SweetAlert2 is working!");
    
         
            let id_proveedor=$("#id_proveedor").val();  
            let direccion=$("#direccion").val();
            let localidad=$("#localidad").val();
            let provincia=$("#provincia").val();
            let cp=$("#cp").val();
            
            let error=0;
          
           if(id_proveedor==""){
               
               error=1;
               $("#id_proveedor_error").html("Debe introducir un proveedor");
                $("#id_proveedor").addClass("borderError");
           }
        
           if(direccion==""){
               
               error=1;
               $("#direccion_error").html("Debe introducir una direccion");
               $("#direccion").addClass("borderError");
           }
        
         if(localidad==""){
               
               error=1;
               $("#localidad_error").html("Debe introducir una localidad");
               $("#localidad").addClass("borderError");
           }
        
         if(provincia==""){
               
               error=1;
               $("#provincia_error").html("Debe introducir una provincia");
               $("#provincia").addClass("borderError");
           }
            
             if(cp==""){
               
               error=1;
               $("#cp_error").html("Debe introducir un cp");
               $("#cp").addClass("borderError");
           }
        if(error==0){
            //$("#form1").submit();
             $.ajax({
                 data:{id_proveedor:id_proveedor,direccion:direccion,localidad:localidad,provincia:provincia,cp:cp},
                 method:"POST",
                 url: "direcciones_proveedores_insert.php", 
                 success: function(result){
                    
                     if(result>=1){
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
                                location.href="direcciones_proveedores.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
                          Swal.fire("No Insertados correctamente!");
                        
                     }
                }
             });
        }
         
    });  
       
   });
</script>      
      
</body>
</html>