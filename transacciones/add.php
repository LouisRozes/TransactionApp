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

$_POST['fecha'] = $fechaActual = date('Y-m-d');

if (isset($_POST['Monto']) && isset($_POST['Descripcion']) && isset($_POST['fecha'])) {
  $transaccion = new Transacciones();
  $transaccion->Data(0, $_POST['Monto'], $_POST['Descripcion'], $_POST['fecha']);
  $services->Add($transaccion);
  header('Location: ../index.php');
  exit();
}

?>

<?php $layout->printHeader(); ?>

<body>
  <style>
    body {

      background-image: url(https://images.unsplash.com/photo-1557683316-973673baf926?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1000&q=80);

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
  <br>

  <div class="card" style="width:500px ;Margin-Left:300px">
    <div class="card-body">
      <h2>Añadiendo Transacción</h2>
      <form action="add.php" method="POST" id="addform">
        <div class="container mt-5 ">
          <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input required type="number" name="Monto" class="form-control monto" id="monto" required>
          </div>
          <br>
          <div class="mb-3">
            <label for="descrip" class="form-label">Descripción</label>
            <input required type="text" name="Descripcion" class="form-control desc" id="descrip">
          </div>
          <button type="submit" class="btn btn-primary add-transacciones"><b><i class="fa fa-floppy-o" aria-hidden="true">
                Añadir Transacción</i></b> </button>
        </div>
      </form>
    </div>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $(".add-transacciones").on("click", function() {

        if ($('.monto').val().length == 0) {
          alert('Debe completar los campos');
        } else if ($('.monto').val().length == 0) {
          alert('Debe completar los campos');
        } else if (confirm("Ha realizado una transacción los datos han sido guardados, puede verificar los datos en el fichero 'transacciones'")) {
          let id = $(this).data("id");
          window.location.href = "../index.php";
        }
      });
    });
  </script>