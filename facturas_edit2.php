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
        
        $id=$fila["id"];
        $fecha=$fila["fecha"]; 
        $id_clientes=$fila["id_clientes"];
    
    }
?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar factura</h1>
         
      </div>
        
  <form action="#" method="post" enctype="multipart/form-data" id="form1">      
        
<div class="row">
    
        <input type="hidden" name="id" value="<?php echo $id;?>" id="id">
       
        
        
<div class="col-md-6 col-xs-12 bg-success p-3">
  <label for="fecha" class="form-label labelgris">Fecha</label>
     <span id="fecha_error" class="text-danger"></span>
  <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha"  value="<?php echo $fecha;?>">
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
                if($filaClientes["id"]==$id_clientes) $selectedCli="selected";
                ?>
                <option value="<?php echo $filaClientes["id"];?>"   <?php echo $selectedCli;?> ><?php echo $filaClientes["apellidos"];?>, <?php echo $filaClientes["nombre"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
    
    
    
    
    
    
    <?php
    
    $sql="SELECT `id`, `id_facturas`, `id_productos`, `cantidad`, `preciounitario`, `base`, `descuento`, `iva`, `precio`, `created_at`, `updated_at` FROM `lineasfacturas` WHERE  `id_facturas`=".$id;
    $query=$mysqli->query($sql);   
    $numLineas=$query->num_rows;
    if($query->num_rows>0){
        $indice=1;
       while($fila=$query->fetch_assoc()){
        
        $idLinea=$fila["id"]; 
        $id_facturas=$fila["id_facturas"];  
        $id_productos=$fila["id_productos"]; 
        $cantidad=$fila["cantidad"];  
        $preciounitario=$fila["preciounitario"]; 
        $base=$fila["base"];  
        $descuento=$fila["descuento"]; 
        $iva=$fila["iva"];  
        $precio=$fila["precio"]; 
       
    
    ?>
    
    
    
    <input type="hidden" name="idlinea<?php echo $indice;?>" value="<?php echo $idLinea;?>" id="idlinea<?php echo $indice;?>">
    

   
        
 <div class="row mt-3 bg-secondary text-white p-2 mb-2" id="linea<?php echo $indice;?>">     
 
    
<div class="col-md-6">
  <label for="id_productos<?php echo $indice;?>" class="form-label">Producto</label>
     <span id="id_productos_error<?php echo $indice;?>" class="text-danger"></span>
  <select class="form-control select2" id="id_productos<?php echo $indice;?>" name="id_productos<?php echo $indice;?>" >
      <option></option>
        <?php
     
        $sqlProductos="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1";
        $resultProductos=$mysqli->query($sqlProductos);
        if($resultProductos->num_rows>0){
            while($filaProductos=$resultProductos->fetch_assoc()){
                 $selectedProd="";
                if($filaProductos["id"]==$id_productos) $selectedProd="selected";
                ?>
                <option value="<?php echo $filaProductos["id"];?>"  <?php echo $selectedProd;?>><?php echo $filaProductos["producto"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
 
        
  
<div class="col-md-3">
  <label for="cantidad<?php echo $indice;?>" class="form-label">Cantidad</label>
     <span id="cantidad_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="cantidad<?php echo $indice;?>" name="cantidad<?php echo $indice;?>" step="1" value="<?php echo $cantidad;?>">
</div>   

     <div class="col-md-2">&nbsp;</div>
       <div class="col-md-1"><a href="#" id="btndelete<?php echo $indice;?>"><i class="fa-solid fa-trash text-danger"></i></a></div>
        
<div class="col-md-2">
  <label for="preciounitario<?php echo $indice;?>" class="form-label">precio unitario</label>
     <span id="preciounitario_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="preciounitario<?php echo $indice;?>" name="preciounitario<?php echo $indice;?>" step="0.1" value="<?php echo $preciounitario;?>">
</div>   
        
<div class="col-md-2">
  <label for="base<?php echo $indice;?>" class="form-label">base imp</label>
     <span id="base_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="base<?php echo $indice;?>" name="base<?php echo $indice;?>" step="0.1" value="<?php echo $base;?>">
</div>     
        
<div class="col-md-2">
  <label for="descuento<?php echo $indice;?>" class="form-label">descuento</label>
     <span id="descuento_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="descuento<?php echo $indice;?>" name="descuento<?php echo $indice;?>" step="0.1" value="<?php echo $descuento;?>">
</div>  
        
<div class="col-md-2">
  <label for="iva<?php echo $indice;?>" class="form-label">iva</label>
     <span id="iva_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="iva<?php echo $indice;?>" name="iva<?php echo $indice;?>" step="0.1" value="<?php echo $iva;?>">
</div>  
        
<div class="col-md-2">
  <label for="precio<?php echo $indice;?>" class="form-label">precio</label>
     <span id="precio_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="precio<?php echo $indice;?>" name="precio<?php echo $indice;?>" step="0.1" value="<?php echo $precio;?>">
</div>  
 </div>         
   
    <?php
           $indice++;
        }//while
    }//if
    ?>
    <input type="hidden" name="numLineas" value="<?php echo $numLineas;?>" id="numLineas">
    
   
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

        /* let id_productos=$("#id_productos").val();
        let cantidad=$("#cantidad").val();
        let preciounitario=$("#preciounitario").val();
        let base=$("#base").val();
        let descuento=$("#descuento").val();
        let iva=$("#iva").val();
        let idlinea=$("#idlinea").val();
        
         let precio=$("#precio").val();*/
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
                 data:$("#form1").serialize(),
                 method:"POST",
                 url: "facturas_update4.php", 
                 success: function(result){
                    alert(result);
                     if(result>=1){
                         //alert("Datos insertados correctamente!");
                       let timerInterval;
                            Swal.fire({
                              title: "Datos actualziados correctamente!",
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
    
    
    

    <?php
    
    $sql="SELECT `id`, `id_facturas`, `id_productos`, `cantidad`, `preciounitario`, `base`, `descuento`, `iva`, `precio`, `created_at`, `updated_at` FROM `lineasfacturas` WHERE  `id_facturas`=".$id;
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        $indice=1;
       while($fila=$query->fetch_assoc()){
        
        $idLinea=$fila["id"]; 
        $id_facturas=$fila["id_facturas"];  
        $id_productos=$fila["id_productos"]; 
        $cantidad=$fila["cantidad"];  
        $preciounitario=$fila["preciounitario"]; 
        $base=$fila["base"];  
        $descuento=$fila["descuento"]; 
        $iva=$fila["iva"];  
        $precio=$fila["precio"]; 
       
    
    ?>
    
     $("#btndelete<?php echo $indice;?>").click(function(){
         $("#id_productos<?php echo $indice;?>").val('');
         $("#linea<?php echo $indice;?>").hide();
     });
    

    
    $("#id_productos<?php echo $indice;?>").change(function(){
        let id_productos=$("#id_productos<?php echo $indice;?>").val();
         $.ajax({
               
                 data:
                {id_productos:id_productos},
                 method:"POST",
                 url: "getPrecioProducto.php", 
                 success: function(result){
                    
                     let resp=result.split(';');
                        let stock=resp[6];
                 
                        $("#preciounitario<?php echo $indice;?>").val(parseFloat(resp[3]));
                        $("#iva<?php echo $indice;?>").val(resp[4]);
                 }
         });
    });
    
  
    function calcularPrecio(){
        let cantidad=$("#cantidad<?php echo $indice;?>").val();
        let preciounitario=$("#preciounitario<?php echo $indice;?>").val();
        let base=$("#base<?php echo $indice;?>").val();
        let descuento=$("#descuento<?php echo $indice;?>").val();
        let iva=$("#iva<?php echo $indice;?>").val();
        let precio=0;
        
        base=cantidad*preciounitario;
        $("#base<?php echo $indice;?>").val(base);
        descuento=base*descuento;
        base=base-descuento;
        iva=base*iva;
       // descuento=(base+iva)*descuento;
        precio=base+iva;
        
        $("#precio<?php echo $indice;?>").val(precio);
    }
  
    
    $('#cantidad<?php echo $indice;?>, #preciounitario<?php echo $indice;?>, #descuento<?php echo $indice;?>, #iva<?php echo $indice;?>').change(function(){
        calcularPrecio();
    });

    
    <?php
        $indice++;
       }
    }
    ?>
    
    <?php for($indice=1;$indice<=$numLineas;$indice++){?>
    
    $("#id_productos<?php echo $indice;?>").change(function(){
        let id_productos=$("#id_productos<?php echo $indice;?>").val();
         $.ajax({
               
                 data:
                {id_productos:id_productos},
                 method:"POST",
                 url: "getPrecioProducto.php", 
                 success: function(result){
                    
                     let resp=result.split(';');
                        let stock=resp[6];
                 
                        $("#preciounitario<?php echo $indice;?>").val(parseFloat(resp[3]));
                        $("#iva<?php echo $indice;?>").val(resp[4]);
                 }
         });
    });
    
  
    function calcularPrecio(){
        let cantidad=$("#cantidad<?php echo $indice;?>").val();
        let preciounitario=$("#preciounitario<?php echo $indice;?>").val();
        let base=$("#base<?php echo $indice;?>").val();
        let descuento=$("#descuento<?php echo $indice;?>").val();
        let iva=$("#iva<?php echo $indice;?>").val();
        let precio=0;
        
        base=cantidad*preciounitario;
        $("#base<?php echo $indice;?>").val(base);
        descuento=base*descuento;
        base=base-descuento;
        iva=base*iva;
       // descuento=(base+iva)*descuento;
        precio=base+iva;
        
        $("#precio<?php echo $indice;?>").val(precio);
    }
  
    
    $('#cantidad<?php echo $indice;?>, #preciounitario<?php echo $indice;?>, #descuento<?php echo $indice;?>, #iva<?php echo $indice;?>').change(function(){
        calcularPrecio();
    });
    <?php }?>   
});      
      
</script>
</body>
</html>