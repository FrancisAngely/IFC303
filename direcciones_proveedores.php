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
        <h1 class="h2">Direcciones proveedores</h1>
          <a href="direcciones_proveedores_new.php" class="btn btn-primary">Nuevo</a>
      </div>
    <?php
       include("db.php"); 
     ?>
    <table class="table">
    <tr>
        <th>Id</th> 
        <th>Razon Social</th>  
        <th>Direccion</th>
         <th>Localidad</th>  
        <th>Provincia</th>
        <th>CP</th>
        <th>Acciones</th>
   </tr>
    <?php
   // $sql="SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";
        
    $sql="SELECT `direcciones_proveedores`.`id`, `direcciones_proveedores`.`id_proveedor`, `direcciones_proveedores`.`direccion`, `direcciones_proveedores`.`localidad`, `direcciones_proveedores`.`provincia`, `direcciones_proveedores`.`cp`, `direcciones_proveedores`.`created_at`, `direcciones_proveedores`.`updated_at`,`proveedores`.`razon_social` ,provincias.provincia as prov,localidades.localidad as loc FROM `direcciones_proveedores` ";    
    $sql.=" INNER JOIN `proveedores` ON `direcciones_proveedores`.`id_proveedor`=`proveedores`.`id`";
        
        //SELECT `id`, `provincia`, `created_at`, `updated_at` FROM `provincias` WHERE 1
        $sql.=" LEFT JOIN `provincias` ON `direcciones_proveedores`.`provincia`=`provincias`.`id`";
        //SELECT `id`, `id_provincias`, `cmun`, `dc`, `localidad`, `cretead_at`, `updated_at` FROM `localidades` WHERE 1
         $sql.=" LEFT JOIN `localidades` ON `direcciones_proveedores`.`localidad`=`localidades`.`id`";
   
    $query=$mysqli->query($sql);    
    if($query->num_rows>0){
        while($fila=$query->fetch_assoc()){
            //var_dump($fila);
          //  echo "<tr><td>".$fila["id"]."</td><td>".$fila["nombre"]."</td><td>".$fila["apellidos"]."</td></tr>";
        ?>
        <tr>
            <td><?php echo $fila["id"];?></td>
            <td><?php echo $fila["razon_social"];?></td>
            <td><?php echo $fila["direccion"];?></td>
             <td><?php echo $fila["loc"];?></td>
            <td><?php echo $fila["prov"];?></td>
             <td><?php echo $fila["cp"];?></td>
            <td><a href="direcciones_proveedores_edit.php?id=<?php echo $fila["id"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
            &nbsp;&nbsp;
            <a href="direcciones_proveedores_delete.php?id=<?php echo $fila["id"];?>"><i class="fa-solid fa-trash text-danger"></i></a>
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