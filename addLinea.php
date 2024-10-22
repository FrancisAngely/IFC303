<?php
sleep(5);
$indice=$_POST["numLin"];

include("db.php");
?>

 <div class="row mt-3 bg-secondary text-white p-2 mb-2"  data-indice="<?php echo $indice;?>">     
 <input type="hidden" name="idlinea<?php echo $indice;?>" value="" id="idlinea<?php echo $indice;?>">
    
<div class="col-md-6">
  <label for="id_productos<?php echo $indice;?>" class="form-label">Producto</label>
     <span id="id_productos_error<?php echo $indice;?>" class="text-danger"></span>
  <select class="form-control select2 changeProducto" id="id_productos<?php echo $indice;?>" name="id_productos<?php echo $indice;?>">
      <option></option>
        <?php
     
        $sqlProductos="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1";
        $resultProductos=$mysqli->query($sqlProductos);
        if($resultProductos->num_rows>0){
            while($filaProductos=$resultProductos->fetch_assoc()){
               
                ?>
                <option value="<?php echo $filaProductos["id"];?>"  ><?php echo $filaProductos["producto"];?></option>
        <?php
            }
        }
        ?>
        
    </select>
</div>
 
        
  
<div class="col-md-3">
  <label for="cantidad<?php echo $indice;?>" class="form-label">Cantidad</label>
     <span id="cantidad_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control calculaPrecio" id="cantidad<?php echo $indice;?>" name="cantidad<?php echo $indice;?>" step="1" value="">
</div>   

     <div class="col-md-2">&nbsp;</div>
       <div class="col-md-1"><a href="#" class="eliminar" ><i class="fa-solid fa-trash text-danger"></i></a></div>
        
<div class="col-md-2">
  <label for="preciounitario<?php echo $indice;?>" class="form-label">precio unitario</label>
     <span id="preciounitario_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control calculaPrecio" id="preciounitario<?php echo $indice;?>" name="preciounitario<?php echo $indice;?>" step="0.1" value="">
</div>   
        
<div class="col-md-2">
  <label for="base<?php echo $indice;?>" class="form-label">base imp</label>
     <span id="base_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control calculaPrecio" id="base<?php echo $indice;?>" name="base<?php echo $indice;?>" step="0.1" value="">
</div>     
        
<div class="col-md-2">
  <label for="descuento<?php echo $indice;?>" class="form-label">descuento</label>
     <span id="descuento_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control calculaPrecio" id="descuento<?php echo $indice;?>" name="descuento<?php echo $indice;?>" step="0.1" value="">
</div>  
        
<div class="col-md-2">
  <label for="iva<?php echo $indice;?>" class="form-label">iva</label>
     <span id="iva_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control calculaPrecio" id="iva<?php echo $indice;?>" name="iva<?php echo $indice;?>" step="0.1" value="">
</div>  
        
<div class="col-md-2">
  <label for="precio<?php echo $indice;?>" class="form-label">precio</label>
     <span id="precio_error<?php echo $indice;?>" class="text-danger"></span>
  <input type="number" class="form-control" id="precio<?php echo $indice;?>" name="precio<?php echo $indice;?>" step="0.1" value="">
</div>  
 </div> 



<script>

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
   
</script>