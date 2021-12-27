<?php
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'transaccion.php';
require_once '../service/IServicesBase.php';
require_once 'serviceCookie.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'serviceFile.php';

$layout = new Layout();
$services = new ServiceFile();
$utilities = new Utilities();

if (isset($_GET['id'])) {
    $transId = $_GET['id'];
    $element =  $services->GetById($transId);

    if (isset($_POST['Monto']) && isset($_POST['Descripcion']) && isset($_POST['fecha'])) {
        $transaccion = new Transacciones();
        $transaccion->Data($transId, $_POST['Monto'], $_POST['Descripcion'], $_POST['fecha']);
        $services->Edit($transId, $transaccion);
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}

?>
<?php $layout->printHeader(); ?>

<body>
    <style>
        body {

            background-image: url(https://wallpaper.dog/large/20408093.jpg);

            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-color: #464646;

        }

        h2 {
            color: black
        }

        label {
            color: black;
        }
    </style>
    <br>
    <br>
   
    <div class="card" style="width:500px ;Margin-Left:300px">
        <div class="card-body">

            <h2>Editando Transacción</h2>
            <form action="edit.php?id=<?php echo $element->id ?>" method="POST">
                <div class="container mt-5 ">
                     <div class="mb-3">
                        <label for="monto" class="form-label">Monto</label>
                        <input type="text" name="Monto" class="form-control" value="<?php echo $element->Monto ?>" id="monto">
                </div>

                <br>

                <div class="mb-3">
                    <label for="descrip" class="form-label">Descripción</label>
                    <input type="text" name="Descripcion" class="form-control" value="<?php echo $element->Descripcion ?>" id="descrip">
                </div>

                <br>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" onload="getfecha()" value="<?php echo $element->fecha ?>" id="fecha">
                </div>

                <br>
                <button type="submit" class="btn btn-primary"><b><i class="fa fa-floppy-o save-changes" aria-hidden="true"> Guardar Cambios</i></b> </button>
        </div>
        </form>

    </div>
    </div>

</body>

</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $(".save-changes").on("click", function() {

        if (confirm("Los cambios han sido guardados, puede verificar los cambios en el fichero 'transacciones'")) {
          let id = $(this).data("id");
          window.location.href = "../index.php";
        }
      });
    });
  </script>