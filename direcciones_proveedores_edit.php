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
        <h1 class="h2">Modificar dirección proveedor</h1>
         
      </div>
        
        
<?php
 include("db.php");
$sqlP="SELECT `id`, `id_proveedor`, `direccion`, `localidad`, `provincia`, `cp`, `created_at`, `updated_at` FROM `direcciones_proveedores` WHERE  `id`=".$_GET["id"];
    $queryP=$mysqli->query($sqlP);    
    if($queryP->num_rows>0){
        $filaP=$queryP->fetch_assoc();
    
    }
?>         
<div class="col-4">
     
    <form action="direcciones_proveedores_update.php" method="post" enctype="multipart/form-data">
        
<input type="hidden" name="id" value="<?php echo $filaP["id"];?>" id="id">


<div class="mb-3">
  <label for="id_proveedor" class="form-label">Proveedor</label>
  <span id="id_proveedor_error" class="text-danger"></span>
  <select class="form-control" id="id_proveedor" name="id_proveedor">
  <option></option>
  <?php
      include("db.php");
    $sql="SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";
   
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        while($fila=$query->fetch_assoc()){
        $selected="";
        if( $fila["id"]== $filaP["id_proveedor"])$selected="selected";
        ?>
      <option value="<?php echo $fila["id"];?>"   <?php echo  $selected;?>      ><?php echo $fila["razon_social"];?>-<?php echo $fila["cif"];?></option>
    <?php }
    }
    ?>
 </select>
</div>
        
       
        
<div class="mb-3">
  <label for="direccion" class="form-label">Dirección</label>
    <span id="direccion_error" class="text-danger"></span>
  <input type="text" class="form-control" id="direccion" name="direccion" placeholder="dirección" value="<?php echo $filaP["direccion"];?>">
</div>

<div class="mb-3">
  <label for="provincia" class="form-label">provincia</label>
<span id="provincia_error" class="text-danger"></span>
    <select class="form-control select2" id="provincia" name="provincia" >
      <option></option>
        <?php
        $sqlProvincias="SELECT `id`, `provincia`, `created_at`, `updated_at` FROM `provincias` WHERE 1 ORDER BY provincia asc";
        $resultProv=$mysqli->query($sqlProvincias);
        if($resultProv->num_rows>0){
            while($filaProv=$resultProv->fetch_assoc()){
                $seleccionarProv="";
                if($filaProv["id"]==$filaP["provincia"]){
                    $seleccionarProv="selected";
                }
                
                ?>
                <option value="<?php echo $filaProv["id"];?>"  <?php echo $seleccionarProv;?>   ><?php echo $filaProv["provincia"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
    
<div class="mb-3">
  <label for="localidad" class="form-label">Localidad</label>
    <span id="localidad_error" class="text-danger"></span>
    <select class="form-control select2" id="localidad" name="localidad" >
      <option></option>
        <?php
        $sqlLocalidades="SELECT `id`, `id_provincias`, `cmun`, `dc`, `localidad`, `cretead_at`, `updated_at` FROM `localidades` WHERE `id_provincias`='".$filaP["provincia"]."'";
        $resultLoc=$mysqli->query($sqlLocalidades);
        if($resultLoc->num_rows>0){
            while($filaLoc=$resultLoc->fetch_assoc()){
                $seleccionarLoc="";
                if($filaLoc["id"]==$filaP["localidad"]){
                    $seleccionarLoc="selected";
                }
                
                ?>
                <option value="<?php echo $filaLoc["id"];?>"  <?php echo $seleccionarLoc;?>   ><?php echo $filaLoc["localidad"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
    
    
    
    
</div>
        
      
   


<div class="mb-3">
  <label for="cp" class="form-label">CP</label>
    <span id="cp_error" class="text-danger"></span>
  <input type="text" class="form-control" id="cp" name="cp" placeholder="cp" value="<?php echo $filaP["cp"];?>">
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
    
            let id=$("#id").val();  
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
                 data:{id_proveedor:id_proveedor,direccion:direccion,localidad:localidad,provincia:provincia,cp:cp,id:id},
                 method:"POST",
                 url: "direcciones_proveedores_update.php", 
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
                                location.href="direcciones_proveedores.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
                          Swal.fire("No Actualizado correctamente!");
                        
                     }
                }
             });
        }
         
    });
       
       
       
       
   });
</script>      
</body>
</html>