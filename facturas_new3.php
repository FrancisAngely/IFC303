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

?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nueva factura</h1>
         
      </div>
        
  <form action="#" method="post" enctype="multipart/form-data" id="form1">      
        
<div class="row">
    
     
       
        
        
<div class="col-md-6 col-xs-12 bg-success p-3">
  <label for="fecha" class="form-label labelgris">Fecha</label>
     <span id="fecha_error" class="text-danger"></span>
  <input type="date" class="form-control" id="fecha" name="fecha" placeholder="fecha"  value="">
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
               
                ?>
                <option value="<?php echo $filaClientes["id"];?>"   ><?php echo $filaClientes["apellidos"];?>, <?php echo $filaClientes["nombre"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
    
    
    
    
    <div id="lineasFactura">
    
      
    
           <div class="row">
            <div class="col-md-12 text-center" id="proceso"></div>
           
        </div>
    </div>      
        <div class="row mt-5 mb-5   ">
            <div class="col-md-4"> &nbsp;</div>
            <div class="col-md-4"> 
                <input type="button" class="form-control" value="Añadir producto" id="btnAdd">
            </div> 
            
             <div class=" col-md-4"> 
                <input type="button" class="form-control" value="Añadir producto 2" id="btnAdd2">
            </div> 
        </div>
<div class="mb-3"> 
  <input type="button" class="form-control" value="Aceptar" id="btnform1">
</div>
    
    <input type="hidden" name="numLineas" value="0" id="numLineas">
    

     </div>
    </form>   

      
    </main>
 
</div>
 <?php include("scripts.php");?> 
      <script>
$( document ).ready(function() {
      let numLineas=0;
    
    
    $("#btnAdd2").click(function(){
        $('#btnAdd2').attr('disabled', true);
        numLineas++;
        $.ajax({
                 data:{numLin:numLineas},
                 method:"POST",
                 url: "addLinea.php", 
                beforeSend: function () {
                            $("#proceso").html("<img src='cargando.gif' class='img-fluid'>");
                },
                 success: function(result){
                   $("#proceso").html("");
                      $("#lineasFactura").append(result);
                     $('#btnAdd2').attr('disabled', false);
                     
                }
             });
    });
    
    
  
 
    $("#btnAdd").click(function(){
        
        numLineas++;
        $("#numLineas").val(numLineas);
       let linea=''; 
        linea+='<div class="row mt-3 bg-secondary text-white p-2 mb-2"  data-indice="'+numLineas+'">';     
  
 linea+='<div class="col-md-6">';
   linea+='<label for="id_productos'+numLineas+'" class="form-label">Producto</label>';
      linea+='<span id="id_productos_error'+numLineas+'" class="text-danger"></span>';
   linea+='<select class="form-control select2 changeProducto" id="id_productos'+numLineas+'" name="id_productos'+numLineas+'">';
       linea+='<option></option>';
        <?php
     
        $sqlProductos="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1";
        $resultProductos=$mysqli->query($sqlProductos);
        if($resultProductos->num_rows>0){
            while($filaProductos=$resultProductos->fetch_assoc()){
              
                ?>
                 linea+='<option value="<?php echo $filaProductos["id"];?>"><?php echo $filaProductos["producto"];?></option>';
        <?php
            }
        }
        ?>
        
    linea+=' </select>';
 linea+='</div>';
 
        
  
 linea+='<div class="col-md-3">';
   linea+='<label for="cantidad'+numLineas+'" class="form-label">Cantidad</label>';
      linea+='<span id="cantidad_error'+numLineas+'" class="text-danger"></span>';
   linea+='<input type="number" class="form-control calculaPrecio" id="cantidad'+numLineas+'" name="cantidad'+numLineas+'" step="1" value="">';
 linea+='</div>';   

      linea+='<div class="col-md-2">&nbsp;</div>';
        linea+='<div class="col-md-1"><a href="#" class="   eliminar" ><i class="fa-solid fa-trash text-danger"></i>';
        linea+='</a></div>';
        
 linea+='<div class="col-md-2">';
  linea+=' <label for="preciounitario'+numLineas+'" class="form-label">precio unitario</label>';
      linea+='<span id="preciounitario_error'+numLineas+'" class="text-danger"></span>';
   linea+='<input type="number" class="form-control calculaPrecio" id="preciounitario'+numLineas+'" name="preciounitario'+numLineas+'" step="0.1" value="">';
 linea+='</div>';
        
 linea+='<div class="col-md-2">';
   linea+='<label for="base'+numLineas+'" class="form-label">base imp</label>';
      linea+='<span id="base_error'+numLineas+'" class="text-danger"></span>';
  linea+=' <input type="number" class="form-control calculaPrecio" id="base'+numLineas+'" name="base'+numLineas+'" step="0.1" value="">';
 linea+='</div>';     
        
 linea+='<div class="col-md-2">';
   linea+='<label for="descuento'+numLineas+'" class="form-label">descuento</label>';
      linea+='<span id="descuento_error'+numLineas+'" class="text-danger"></span>';
   linea+='<input type="number" class="form-control calculaPrecio" id="descuento'+numLineas+'" name="descuento'+numLineas+'" step="0.1" value="">';
 linea+='</div>';
        
 linea+='<div class="col-md-2">';
   linea+='<label for="iva'+numLineas+'" class="form-label">iva</label>';
     linea+=' <span id="iva_error'+numLineas+'" class="text-danger"></span>';
   linea+='<input type="number" class="form-control calculaPrecio" id="iva'+numLineas+'" name="iva'+numLineas+'" step="0.1" value="">';
 linea+='</div>';  
        
 linea+='<div class="col-md-2">';
   linea+='<label for="precio'+numLineas+'" class="form-label">precio</label>';
      linea+='<span id="precio_error'+numLineas+'" class="text-danger"></span>';
   linea+='<input type="number" class="form-control" id="precio'+numLineas+'" name="precio'+numLineas+'" step="0.1" value="">';
 linea+='</div>';  
  linea+='</div>';    
  linea+='</div>';    
        
         linea+='<script>';
         linea+='$(".eliminar").click(function(){';
        linea+='let linea=$(this).parent().parent().attr("data-indice");';
      
        linea+='$("#id_productos"+linea).val("");';
      linea+='$(this).parent().parent().hide();';
      
    linea+=' });';
        
        
        
        linea+='$(".changeProducto").change(function(){';
     
        linea+='let id_productos=$(this).val();';
        linea+='let indice=$(this).parent().parent().attr("data-indice");';
      
         linea+='$.ajax({';
               
                 linea+='data:';
                linea+='{id_productos:id_productos},';
                 linea+='method:"POST",';
                 linea+='url: "getPrecioProducto.php", ';
                 linea+='success: function(result){';
                    
                     linea+='let resp=result.split(";");';
                        linea+='let stock=resp[6];';
                        linea+='$("#preciounitario"+indice).val(parseFloat(resp[3]));';
                        linea+='$("#iva"+indice).val(resp[4]);';
                 linea+='}';
         linea+='});';
    linea+='});';
        
        
        linea+='$(".calculaPrecio").change(function(){';
       linea+='let linea=$(this).parent().parent().attr("data-indice");';
      
        linea+='let cantidad=$("#cantidad"+linea).val();';
        linea+='let preciounitario=$("#preciounitario"+linea).val();';
        linea+='let base=$("#base"+linea).val();';
        linea+='let descuento=$("#descuento"+linea).val();';
        linea+='let iva=$("#iva"+linea).val();';
        linea+='let precio=0;';
        
        linea+='base=cantidad*preciounitario;';
        linea+='$("#base"+linea).val(base);';
        linea+='descuento=base*descuento;';
        linea+='base=base-descuento;';
        linea+='iva=base*iva;';
       
        linea+='precio=base+iva;';
        
        linea+='$("#precio"+linea).val(precio);';
    linea+='});';
        
        linea+='<\/script>';
        
        
        
        
        $("#lineasFactura").append(linea);
    });
   
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
                 data:$("#form1").serialize(),
                 method:"POST",
                /* processData: false, 
                 contentType: false,
                  cache: false,*/
                 url: "facturas_insert4.php", 
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
    
    
    

   
    
    $(".changeProducto").change(function(){
     
        let id_productos=$(this).val();
       //let linea=$(this).attr("data-indice");
        let indice=$(this).parent().parent().attr("data-indice");
      
         $.ajax({
               
                 data:
                {id_productos:id_productos},
                 method:"POST",
                 url: "getPrecioProducto.php", 
                 success: function(result){
                    
                     let resp=result.split(';');
                        let stock=resp[6];
                        $("#preciounitario"+indice).val(parseFloat(resp[3]));
                        $("#iva"+indice).val(resp[4]);
                 }
         });
    });
    
  $(".calculaPrecio").change(function(){
       let linea=$(this).parent().parent().attr("data-indice");
      
        let cantidad=$("#cantidad"+linea).val();
        let preciounitario=$("#preciounitario"+linea).val();
        let base=$("#base"+linea).val();
        let descuento=$("#descuento"+linea).val();
        let iva=$("#iva"+linea).val();
        let precio=0;
        
        base=cantidad*preciounitario;
        $("#base"+linea).val(base);
        descuento=base*descuento;
        base=base-descuento;
        iva=base*iva;
       // descuento=(base+iva)*descuento;
        precio=base+iva;
        
        $("#precio"+linea).val(precio);
    });
   
 $(".eliminar").click(function(){
       let linea=$(this).parent().parent().attr("data-indice");
      
       $("#id_productos"+linea).val('');
     $(this).parent().parent().hide();
      
    });
   
    
    
    
    });      
      
</script>
</body>
</html>