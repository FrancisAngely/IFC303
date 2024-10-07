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
$sql="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE `id`=".$_GET["id"];
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        $fila=$query->fetch_assoc();
    
    }
?>
      
      
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Editar producto</h1>
         
      </div>
<div class="col-4">
    <form action="productos_update.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $fila["id"];?>">
        <!-- SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1-->
        
<div class="mb-3">
  <label for="producto" class="form-label">Producto</label>
  <input type="text" class="form-control" id="producto" name="producto" placeholder="producto"  value="<?php echo $fila["producto"];?>">
</div>

<div class="mb-3">        
        
<?php if($fila["imagen"]!=""){?>
        <img src="<?php echo $fila["imagen"];?>" class="img-fluid">
<?php }?>
</div>        
        
<div class="mb-3">
  <label for="imagen" class="form-label">imagen</label>
  <input type="file" class="form-control" id="imagen" name="imagen">
</div>
        
<div class="mb-3">
  <label for="precio" class="form-label">precio</label>
  <input type="number" step="0.01" class="form-control" id="precio" name="precio"  value="<?php echo $fila["precio"];?>">
</div>
        
<div class="mb-3">
  <label for="iva" class="form-label">iva</label>
  <input type="number" step="0.01" class="form-control" id="iva" name="iva"  value="<?php echo $fila["iva"];?>">
</div>
        
<div class="mb-3">
  <label for="stock" class="form-label">stock</label>
  <input type="number"  class="form-control" id="stock" name="stock"  value="<?php echo $fila["stock"];?>">
</div>
   
<div class="mb-3"> 
  <input type="submit" class="form-control" value="Aceptar">
</div>
    
    </form>
 </div>      
      

      
    </main>
  </div>
</div>
 <?php include("scripts.php");?>     
</body>
</html>