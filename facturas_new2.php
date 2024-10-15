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

<form action="#" method="post" enctype="multipart/form-data" id="form1">
<div class="row">
   
<div class="col-md-6 bg-info p-3">
  <label for="fecha" class="form-label">Fecha</label>
     <span id="fecha_error" class="text-danger"></span>
  <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha">
</div>

    
<div class="col-md-6  bg-primary p-3">
  <label for="id_clientes" class="form-label text-white">Cliente</label>
     <span id="id_clientes_error" class="text-danger"></span>
  <select class="form-control select2" id="id_clientes" name="id_clientes" >
      <option></option>
        <?php
      include("db.php");
        $sqlClientes="SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes`  ORDER BY apellidos,nombre";
        $resultClientes=$mysqli->query($sqlClientes);
        if($resultClientes->num_rows>0){
            while($filaClientes=$resultClientes->fetch_assoc()){
                ?>
                <option value="<?php echo $filaClientes["id"];?>"><?php echo $filaClientes["apellidos"];?>, <?php echo $filaClientes["nombre"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
    
<?php
    include("db.php");
    
    $numproductos=5;
?>
    
<?php for($i=1;$i<=$numproductos;$i++){
    if($i%2==0){$bg="bg-warning";}else{$bg="bg-secondary";}
    ?>
<div class="row mt-5 <?php echo $bg;?> p-5" id="lineaproducto<?php echo $i;?>">  
         
<div class="mb-3 col-md-6">
  <label for="id_productos<?php echo $i;?>" class="form-label">Producto</label>
     <span id="id_productos_error<?php echo $i;?>" class="text-danger"></span>
  <select class="form-control select2" id="id_productos<?php echo $i;?>" name="id_productos<?php echo $i;?>" >
      <option></option>
        <?php
      
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
 
        
  
<div class="mb-3 col-md-2">
  <label for="cantidad<?php echo $i;?>" class="form-label">Cantidad</label>
     <span id="cantidad_error<?php echo $i;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="cantidad<?php echo $i;?>" name="cantidad<?php echo $i;?>" step="1">
</div>   

    <div class="mb-3 col-md-4">&nbsp;</div>
    
<div class="mb-3 col-md-2">
  <label for="preciounitario<?php echo $i;?>" class="form-label">precio unitario</label>
     <span id="preciounitario_error<?php echo $i;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="preciounitario<?php echo $i;?>" name="preciounitario<?php echo $i;?>" step="0.01">
</div>   
        
<div class="mb-3 col-md-2">
  <label for="base<?php echo $i;?>" class="form-label">base imp</label>
     <span id="base_error<?php echo $i;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="base<?php echo $i;?>" name="base<?php echo $i;?>" step="0.01">
</div>     
        
<div class="mb-3 col-md-2">
  <label for="descuento<?php echo $i;?>" class="form-label">descuento</label>
     <span id="descuento_error<?php echo $i;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="descuento<?php echo $i;?>" name="descuento<?php echo $i;?>" step="0.01">
</div>  
        
<div class="mb-3 col-md-2">
  <label for="iva<?php echo $i;?>" class="form-label">iva</label>
     <span id="iva_error<?php echo $i;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="iva<?php echo $i;?>" name="iva<?php echo $i;?>" step="0.01">
</div>  
        
<div class="mb-3 col-md-2">
  <label for="precio<?php echo $i;?>" class="form-label">precio</label>
     <span id="precio_error<?php echo $i;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="precio<?php echo $i;?>" name="precio<?php echo $i;?>" step="0.01">
</div>  
    
</div>   
    
<?php }?>   
   
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
           let fecha=$("#fecha").val();  
           let id_clientes=$("#id_clientes").val();
        
        //LINEA PRODUCTO 
        <!--
                let id_productos1=$("#id_productos1").val();
                let cantidad1=$("#cantidad1").val();
                let preciounitario1=$("#preciounitario1").val();
                let base1=$("#base1").val();
                let descuento1=$("#descuento1").val();
                let iva1=$("#iva1").val();
                let precio1=$("#precio1").val();
        
        
            let error=0; -->
          
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
        
        //linea producto
        
         if(id_productos1==""){
               
               error=1;
               $("#id_productos_error1").html("Debe introducir un producto");
               $("#id_productos1").addClass("borderError");
           }
        
        if(cantidad1==""){
               
               error=1;
               $("#cantidad_error1").html("Debe introducir una cantidad");
               $("#cantidad1").addClass("borderError");
           }
        
        if(preciounitario1==""){
               
               error=1;
               $("#preciounitario_error1").html("Debe introducir un precio unitario");
               $("#preciounitario1").addClass("borderError");
           }
        
        if(base1==""){
               
               error=1;
               $("#base_error1").html("Debe introducir una  base imponible");
               $("#base1").addClass("borderError");
           }
        
        if(iva1==""){
               
               error=1;
               $("#iva_error1").html("Debe introducir un iva");
               $("#iva1").addClass("borderError");
           }
        if(precio1==""){
               
               error=1;
               $("#precio_error1").html("Debe introducir un precio");
               $("#precio1").addClass("borderError");
           }
        
        <?php for($i=2;$i<=$numproductos;$i++){?>
                let id_productos<?php echo $i;?>=$("#id_productos<?php echo $i;?>").val();
        
                
                let cantidad<?php echo $i;?>=$("#cantidad<?php echo $i;?>").val();
                let preciounitario<?php echo $i;?>=$("#preciounitario<?php echo $i;?>").val();
                let base<?php echo $i;?>=$("#base<?php echo $i;?>").val();
                let descuento<?php echo $i;?>=$("#descuento<?php echo $i;?>").val();
                let iva<?php echo $i;?>=$("#iva<?php echo $i;?>").val();
                let precio<?php echo $i;?>=$("#precio<?php echo $i;?>").val();
                if(id_productos<?php echo $i;?>!=""){
                            if(cantidad<?php echo $i;?>==""){
               
                           error=1;
                           $("#cantidad_error<?php echo $i;?>").html("Debe introducir una cantidad");
                           $("#cantidad<?php echo $i;?>").addClass("borderError");
                       }

                    if(preciounitario<?php echo $i;?>==""){

                           error=1;
                           $("#preciounitario_error<?php echo $i;?>").html("Debe introducir un precio unitario");
                           $("#preciounitario<?php echo $i;?>").addClass("borderError");
                       }

                    if(base<?php echo $i;?>==""){

                           error=1;
                           $("#base_error<?php echo $i;?>").html("Debe introducir una  base imponible");
                           $("#base<?php echo $i;?>").addClass("borderError");
                       }

                    if(iva<?php echo $i;?>==""){

                           error=1;
                           $("#iva_error<?php echo $i;?>").html("Debe introducir un iva");
                           $("#iva<?php echo $i;?>").addClass("borderError");
                       }
                    if(precio<?php echo $i;?>==""){

                           error=1;
                           $("#precio_error<?php echo $i;?>").html("Debe introducir un precio");
                           $("#precio<?php echo $i;?>").addClass("borderError");
                       }
                    
                }
    
        <?php }?>    
        
        
        <?php for($i=1;$i<=$numproductos;$i++){?>
                id_productos<?php echo $i;?>=$("#id_productos<?php echo $i;?>").val();
        
                
                 cantidad<?php echo $i;?>=$("#cantidad<?php echo $i;?>").val();
                preciounitario<?php echo $i;?>=$("#preciounitario<?php echo $i;?>").val();
                base<?php echo $i;?>=$("#base<?php echo $i;?>").val();
               descuento<?php echo $i;?>=$("#descuento<?php echo $i;?>").val();
               iva<?php echo $i;?>=$("#iva<?php echo $i;?>").val();
               precio<?php echo $i;?>=$("#precio<?php echo $i;?>").val();
        <?php }?>
        if(error==0){
            //$("#form1").submit();
             $.ajax({
                 data:{fecha:fecha,id_clientes:id_clientes
             <?php for($i=1;$i<=$numproductos;$i++){?> ,id_productos<?php echo $i;?>:id_productos<?php echo $i;?>,cantidad<?php echo $i;?>:cantidad<?php echo $i;?>,preciounitario<?php echo $i;?>:preciounitario<?php echo $i;?>,base<?php echo $i;?>:base<?php echo $i;?>,descuento<?php echo $i;?>:descuento<?php echo $i;?>,iva<?php echo $i;?>:iva<?php echo $i;?>,precio<?php echo $i;?>:precio<?php echo $i;?>
               <?php }?>     
            ,numproductos:<?php echo $numproductos;?>
            },
                 method:"POST",
                 url: "facturas_insert2.php", 
                 success: function(result){
                    //alert(result);
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
    
    
    
      $("#id_clientes").change(function(){
          let id_clientes=$("#id_clientes").val();
          if(id_clientes==""){
               
               error=1;
               $("#id_clientes_error").html("Debe introducir los id_clientes");
               $("#id_clientes").addClass("borderError");
           }else{
               $("#id_clientes_error").html("");
                $("#id_clientes").removeClass("borderError");
           }
    }); 
       
    
    $("#fecha").change(function(){
          let fecha=$("#fecha").val();
          if(fecha==""){
               
               error=1;
               $("#fecha_error").html("Debe introducir una fecha");
               $("#fecha").addClass("borderError");
           }else{
               $("#fecha_error").html("");
                $("#fecha").removeClass("borderError");
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
    
    
    //CALCULAR PRECIO PRODUCTO
    
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
    
 
    
    $('#cantidad, #preciounitario, #descuento, #iva').change(function(){
        calcularPrecio();
    });
    
    
    
});      
      
</script>
</body>
</html>