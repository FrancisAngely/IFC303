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
        <h1 class="h2">Productos</h1>
          <a href="productos_new.php" class="btn btn-primary">Nuevo</a>
      </div>
    <?php
       include("db.php"); 
     ?>
    <table class="table">
    <tr>
        <th>Id</th> 
        <th>Producto</th>  
        <th>Imagen</th>
        <th>precio</th>
        <th>iva</th>
         <th>stock</th>
        <th>Acciones</th>
   </tr>
    <?php
    $sql="SELECT `id`, `producto`, `imagen`, `precio`, `iva`, `stock`, `created_at`, `updated_at` FROM `productos` WHERE 1";
   
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        while($fila=$query->fetch_assoc()){
            //var_dump($fila);
          //  echo "<tr><td>".$fila["id"]."</td><td>".$fila["nombre"]."</td><td>".$fila["apellidos"]."</td></tr>";
        ?>
        <tr>
            <td><?php echo $fila["id"];?></td>
            <td><?php echo $fila["producto"];?></td>
            <td><?php echo $fila["imagen"];?></td>
             <td><?php echo $fila["precio"];?></td>
             <td><?php echo $fila["iva"];?></td>
             <td><?php echo $fila["stock"];?></td>
            <td><a href="productos_edit.php?id=<?php echo $fila["id"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
            &nbsp;&nbsp;
            <a href="productos_delete.php?id=<?php echo $fila["id"];?>"><i class="fa-solid fa-trash text-danger"></i></a>
            </td>
        </tr>
        <?php
        }
    }    
    ?>
        
    </table>
        
      

      
    </main>
  </div>
</div>
 <?php include("scripts.php");?>     
</body>
</html>