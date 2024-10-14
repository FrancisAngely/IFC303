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
$sql="SELECT `id`, `fecha`, `id_clientes`, `created_at`, `updated_at` FROM `facturas` WHERE `id`=".$_GET["id"];
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        $fila=$query->fetch_assoc();
    
    }
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar factura</h1>
         
      </div>
        
  <form action="#" method="post" enctype="multipart/form-data" id="form1">      
        
<div class="row">
    
        <input type="hidden" name="id" value="<?php echo $fila["id"];?>" id="id">
       
        
        
<div class="col-md-6 col-xs-12 bg-success p-3">
  <label for="fecha" class="form-label labelgris">Fecha</label>
     <span id="fecha_error" class="text-danger"></span>
  <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha"  value="<?php echo $fila["fecha"];?>">
</div>

    
<div class="col-md-6 col-xs-12 bg-secondary p-3">
  <label for="id_clientes" class="form-label  labelgris">Clientes</label>
     <span id="id_clientes_error" class="text-danger"></span>
  <select class="form-control select2" id="id_clientes" name="id_clientes" >
      <option></option>
        <?php
      
        $sqlClientes="SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes`  ORDER BY apellidos,nombre";
        $resultClientes=$mysqli->query($sqlClientes);
        if($resultClientes->num_rows>0){
            while($filaClientes=$resultClientes->fetch_assoc()){
                $selectedCli="";
                if($filaClientes["id"]==$fila["id_clientes"]) $selectedCli="selected";
                ?>
                <option value="<?php echo $filaClientes["id"];?>"   <?php echo $selectedCli;?> ><?php echo $filaClientes["apellidos"];?>, <?php echo $filaClientes["nombre"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
    
    
    
    
    
    
    <?php
    
    $sql="SELECT `id`, `id_facturas`, `id_productos`, `cantidad`, `preciounitario`, `base`, `descuento`, `iva`, `precio`, `created_at`, `updated_at` FROM `lineasfacturas` WHERE  `id`=".$_GET["id"];
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        $fila=$query->fetch_assoc();
    
    }
    
    ?>
    
    
    
    <input type="hidden" name="idlinea" value="<?php echo $fila["id"];?>" id="idlinea">
    

   
        
 <div class="row mt-3 bg-secondary text-white p-2 mb-2">     
 
    
<div class="col-md-6">
  <label for="id_productos" class="form-label">Producto</label>
     <span id="id_productos_error" class="text-danger"></span>
  <select class="form-control select2" id="id_productos" name="id_productos" >
      <option></option>
        <?php
     
        $sqlProductos="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1";
        $resultProductos=$mysqli->query($sqlProductos);
        if($resultProductos->num_rows>0){
            while($filaProductos=$resultProductos->fetch_assoc()){
                 $selectedProd="";
                if($filaProductos["id"]==$fila["id_productos"]) $selectedProd="selected";
                ?>
                <option value="<?php echo $filaProductos["id"];?>"  <?php echo $selectedProd;?>><?php echo $filaProductos["producto"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
 
        
  
<div class="col-md-3">
  <label for="cantidad" class="form-label">Cantidad</label>
     <span id="cantidad_error" class="text-danger"></span>
  <input type="number" class="form-control" id="cantidad" name="cantidad" step="1" value="<?php echo $fila["cantidad"];?>">
</div>   

     <div class="col-md-3">&nbsp;</div>
        
<div class="col-md-2">
  <label for="preciounitario" class="form-label">precio unitario</label>
     <span id="preciounitario_error" class="text-danger"></span>
  <input type="number" class="form-control" id="preciounitario" name="preciounitario" step="0.1" value="<?php echo $fila["preciounitario"];?>">
</div>   
        
<div class="col-md-2">
  <label for="base" class="form-label">base imp</label>
     <span id="base_error" class="text-danger"></span>
  <input type="number" class="form-control" id="base" name="base" step="0.1" value="<?php echo $fila["base"];?>">
</div>     
        
<div class="col-md-2">
  <label for="descuento" class="form-label">descuento</label>
     <span id="descuento_error" class="text-danger"></span>
  <input type="number" class="form-control" id="descuento" name="descuento" step="0.1" value="<?php echo $fila["descuento"];?>">
</div>  
        
<div class="col-md-2">
  <label for="iva" class="form-label">iva</label>
     <span id="iva_error" class="text-danger"></span>
  <input type="number" class="form-control" id="iva" name="iva" step="0.1" value="<?php echo $fila["iva"];?>">
</div>  
        
<div class="col-md-2">
  <label for="precio" class="form-label">precio</label>
     <span id="precio_error" class="text-danger"></span>
  <input type="number" class="form-control" id="precio" name="precio" step="0.1" value="<?php echo $fila["precio"];?>">
</div>  
 </div>         
    
    
    
    
   
<div class="mb-3"> 
  <input type="button" class="form-control" value="Aceptar" id="btnform1">
</div>
    
   
 </div>       
    </form>   

      
    </main>
  </div>
</div>
 <?php include("scripts.php");?> 
      <script>
$( document ).ready(function() {
   
    $("#btnform1").click(function(){
       // Swal.fire("SweetAlert2 is working!");
         let id=$("#id").val();  
           let fecha=$("#fecha").val();  
           let id_clientes=$("#id_clientes").val();
            let error=0;
          
           if(fecha==""){
               
               error=1;
               $("#fecha_error").html("Debe introducir un fecha");
                $("#fecha").addClass("borderError");
           }
        
           if(id_clientes==""){
               
               error=1;
               $("#id_clientes_error").html("Debe introducir los id_clientes");
               $("#id_clientes").addClass("borderError");
           }
        if(error==0){
            //$("#form1").submit();
             $.ajax({
                 data:{fecha:fecha,id_clientes:id_clientes,id:id,id_productos:id_productos,cantidad:cantidad,preciounitario:preciounitario,base:base,descuento:descuento,iva:iva,precio:precio,idlinea:idlinea},
                 method:"POST",
                 url: "facturas_update2.php", 
                 success: function(result){
                    
                     if(result>=1){
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
    
       
     $("#fecha").on('keyup', function(){
         $("#errorV").html("");
        var value = $(this).val().length;
        if(value>0){
            $("#fecha_error").html("");
            $("#fecha").removeClass("borderError");
        }else{
           $("#fecha_error").html("Debe introducir un fecha de usuario");
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
           $("#id_clientes_error").html("Debe introducir una id_clientes");
           $("#id_clientes").addClass("borderError"); 
        }
    })
    
});      
      
</script>
</body>
</html>