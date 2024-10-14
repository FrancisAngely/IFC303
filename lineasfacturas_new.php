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
    <form action="#" method="post" enctype="multipart/form-data" id="form1">


    
<div class="mb-3">
  <label for="id_facturas" class="form-label">Factura</label>
     <span id="id_facturas_error" class="text-danger"></span>
  <select class="form-control select2" id="id_facturas" name="id_facturas" >
      <option></option>
        <?php
      include("db.php");
        $sqlFacturas="SELECT `facturas`.`id`, `facturas`.`fecha`, `facturas`.`id_clientes`, `facturas`.`created_at`, `facturas`.`updated_at`,CONCAT(clientes.nombre,clientes.apellidos) AS cli FROM `facturas` INNER JOIN clientes ON `facturas`.id_clientes=clientes.id";
        $resultFacturas=$mysqli->query($sqlFacturas);
        if($resultFacturas->num_rows>0){
            while($filaFacturas=$resultFacturas->fetch_assoc()){
                ?>
                <option value="<?php echo $filaFacturas["id"];?>"><?php echo $filaFacturas["id"];?>- <?php echo $filaFacturas["cli"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
   
        
        
        
<div class="mb-3">
  <label for="id_productos" class="form-label">Producto</label>
     <span id="id_productos_error" class="text-danger"></span>
  <select class="form-control select2" id="id_productos" name="id_productos" >
      <option></option>
        <?php
      include("db.php");
        $sqlProductos="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1";
        $resultProductos=$mysqli->query($sqlProductos);
        if($resultProductos->num_rows>0){
            while($filaProductos=$resultProductos->fetch_assoc()){
                ?>
                <option value="<?php echo $filaProductos["id"];?>"><?php echo $filaProductos["producto"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
 
        
  
<div class="mb-3">
  <label for="cantidad" class="form-label">Cantidad</label>
     <span id="cantidad_error" class="text-danger"></span>
  <input type="number" class="form-control" id="cantidad" name="cantidad" step="1">
</div>   
        
<div class="mb-3">
  <label for="preciounitario" class="form-label">precio unitario</label>
     <span id="preciounitario_error" class="text-danger"></span>
  <input type="number" class="form-control" id="preciounitario" name="preciounitario" step="0.01">
</div>   
        
<div class="mb-3">
  <label for="base" class="form-label">base imp</label>
     <span id="base_error" class="text-danger"></span>
  <input type="number" class="form-control" id="base" name="base" step="0.01">
</div>     
        
<div class="mb-3">
  <label for="descuento" class="form-label">descuento</label>
     <span id="descuento_error" class="text-danger"></span>
  <input type="number" class="form-control" id="descuento" name="descuento" step="0.01">
</div>  
        
<div class="mb-3">
  <label for="iva" class="form-label">iva</label>
     <span id="iva_error" class="text-danger"></span>
  <input type="number" class="form-control" id="iva" name="iva" step="0.01">
</div>  
        
<div class="mb-3">
  <label for="precio" class="form-label">precio</label>
     <span id="precio_error" class="text-danger"></span>
  <input type="number" class="form-control" id="precio" name="precio" step="0.01">
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
        
                let id_facturas=$("#id_facturas").val();  
                let id_productos=$("#id_productos").val();

                let cantidad=$("#cantidad").val();
                let preciounitario=$("#preciounitario").val();
                let base=$("#base").val();
                let descuento=$("#descuento").val();
                let iva=$("#iva").val();
                let precio=$("#precio").val();
let error=0;
          
           if(id_facturas==""){
               
               error=1;
               $("#id_facturas_error").html("Debe introducir una factura");
                $("#id_facturas").addClass("borderError");
           }
        
           if(id_productos==""){
               
               error=1;
               $("#id_productos_error").html("Debe introducir un producto");
               $("#id_productos").addClass("borderError");
           }
        
        if(cantidad==""){
               
               error=1;
               $("#cantidad_error").html("Debe introducir una cantidad");
               $("#cantidad").addClass("borderError");
           }
        
        if(preciounitario==""){
               
               error=1;
               $("#preciounitario_error").html("Debe introducir un precio unitario");
               $("#preciounitario").addClass("borderError");
           }
        
        if(base==""){
               
               error=1;
               $("#base_error").html("Debe introducir una  base imponible");
               $("#base").addClass("borderError");
           }
        
        if(iva==""){
               
               error=1;
               $("#iva_error").html("Debe introducir un iva");
               $("#iva").addClass("borderError");
           }
        if(precio==""){
               
               error=1;
               $("#precio_error").html("Debe introducir un precio");
               $("#precio").addClass("borderError");
           }
        if(error==0){
            //$("#form1").submit();
             $.ajax({
               
                 data:
                {id_facturas:id_facturas,id_productos:id_productos,cantidad:cantidad,preciounitario:preciounitario,base:base,descuento:descuento,iva:iva,precio:precio},
                 method:"POST",
                 url: "lineasfacturas_insert.php", 
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
                                location.href="lineasfacturas.php";
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
    
    $("#id_productos").change(function(){
        let id_productos=$("#id_productos").val();
         $.ajax({
               
                 data:
                {id_productos:id_productos},
                 method:"POST",
                 url: "getPrecioProducto.php", 
                 success: function(result){
                     let resp=result.split(';');
                        let stock=resp[6];
                        $("#preciounitario").val(resp[4]);
                        $("#iva").val(resp[5]);
                 }
         });
    });
    
   /*  $("#id_productos").change(function(){
        let id_productos=$("#id_productos").val();
         $.ajax({
               
                 data:
                {id_productos:id_productos},
                 method:"POST",
                 url: "getPrecioProductoSimple.php", 
                 success: function(result){
                  
                        $("#preciounitario").val(result);
                       
                 }
         });
    });*/
    
    function calcularPrecio(){
        let cantidad=$("#cantidad").val();
        let preciounitario=$("#preciounitario").val();
        let base=$("#base").val();
        let descuento=$("#descuento").val();
        let iva=$("#iva").val();
        let precio=0;
        
        base=cantidad*preciounitario;
        $("#base").val(base);
        
        iva=base*iva;
        descuento=(base+iva)*descuento;
        precio=base+iva-descuento;
        $("#precio").val(precio);
    }
    
  /*  $("#cantidad").change(function(){
      
       calcularPrecio();
         
    });
    
      $("#preciounitario").change(function(){
      
      calcularPrecio();
    });
    
      $("#descuento").change(function(){
      
       calcularPrecio();
    });
    
      $("#iva").change(function(){
      
      calcularPrecio();
         
    });*/
    
    $('#cantidad, #preciounitario, #descuento, #iva').change(function(){
        calcularPrecio();
    });
    
});      
      
</script>
</body>
</html>