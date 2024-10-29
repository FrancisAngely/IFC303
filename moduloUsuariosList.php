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
        <h1 class="h2">Usuarios</h1>
      </div>
  <table class="table">
  <tr>
        <th>Id</th> 
        <th>Usuario</th>  
        <th>E-mail</th>
        <th>Acciones</th>
   </tr>
  <?php
    $usuarios=getAllV("usuarios"); 
    if(count($usuarios)>0){
      foreach($usuarios as $u){
        ?>
        <tr>
        <td><?php echo $u["id"];?></td> 
        <td><?php echo $u["usuario"];?></td> 
        <td><?php echo $u["email"];?></td> 
        <td>Acciones</td>        
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