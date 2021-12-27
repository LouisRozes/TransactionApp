<?php
require_once 'layout/layout.php';
require_once 'helpers/utilities.php';
require_once 'transacciones/transaccion.php';
require_once 'service/IServicesBase.php';
require_once 'transacciones/serviceCookie.php';
require_once 'helpers/FileHandler/IFileHandler.php';
require_once 'helpers/FileHandler/JsonFileHandler.php';
require_once 'transacciones/serviceFile.php';

$layout = new Layout(false);
$services = new ServiceFile("transacciones/data");
$utilities = new Utilities();

$listTransacciones=$services->GetList();
?>

<?php $layout->printHeader();?>
<body>
<style>
body{
    
    background-image: url(data:image/jpeg;base64,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);
   
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-color: #464646;
   
} 

label{
color: aliceblue;
}

a{
  color: aliceblue;
}
h2{
  color: aliceblue;
}
</style>

<br><br>
<div class="container">
<a href="transacciones/add.php" class="btn btn-success" type="submit"> <B><i class="fa fa-plus-square" aria-hidden="true"> Añadir Transacción </i></B> </a>
</div>

            
 
<h2 class="pt-5 text-center">Transacciones Realizadas </h2>
<table id="grid" class="table table-striped table-bordered dt-responsive nowrap">

  <thead class="table-dark" style="text-align:center;">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Monto</th>
      <th scope="col">Fecha</th>
      <th scope="col">Descripción</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody class="table-light" style="text-align:center;">
   <?php foreach($listTransacciones as $transaccion):?>
    <tr>
      <th scope="row"><?php echo $transaccion->id?></th>
      <td><?php echo $transaccion->Monto?></td>
      <td><?php echo $transaccion->fecha?></td>
      <td><?php echo $transaccion->Descripcion?></td>

      <td>
        <a href="transacciones/edit.php?id=<?php echo $transaccion->id?>" class="btn btn-warning"><b><i class="fa fa-pencil-square-o" aria-hidden="true"> Editar transacción</i></b></a>
        ⠀⠀⠀⠀
        <a href="#" data-id="<?php echo $transaccion->id?>" class="btn btn-danger delete-transacciones"> <b><i class="fa fa-trash" aria-hidden="true"> Eliminar transacción</i></b> </a>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>


<script>   
$(document).ready(function(){
    $(".delete-transacciones").on("click",function(){
        if(confirm("Esta seguro que desea eliminar esta transaccion?"))
        {
            let id = $(this).data("id");
            window.location.href="transacciones/delete.php?id=" + id;
        }   
    });
});

$(document).ready(function () {
        $('#grid').DataTable();
    });

</script>


