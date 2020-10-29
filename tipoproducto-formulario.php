<?php

include_once('config.php');
include_once('entidades/tipoproducto.php');

$tipo1 = new TipoProducto();

$tipo1->cargarFormulario($_REQUEST);

if($_POST){
  if(isset($_POST['btnGuardar'])){
    if(isset($_GET['id']) && $_GET['id'] > 0){
      $tipo1->actualizar();
    } else {
      $tipo1->insertar();
    }
  } else if (isset($_POST['btnBorrar'])){
    $tipo1->eliminar();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edición de cliente</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('menu.php') ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include('navbar.php') ?>

        <div class="pl-4">
          <h2 class="h3 bt-3 text-gray-800 mb-4">Tipo de productos</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-date">

          <div class="botones-crud ml-4 mb-3">
            <a href="#" class="mr-2 btn btn-primary">Listado</a>
            <button class="mr-2 btn btn-primary">Nuevo</button>
            <button name="btnGuardar" type="submit" id="btnGuardar"class="mr-2 btn btn-success">Guardar</button>
            <button name="btnBorrar" class="btn btn-danger">Borrar</button>
          </div>
          
          <div class="row px-4">
            <div class="form-group col-12">
              <label for="txtNombre" class="text-muted">Nombre:</label>
              <input type="text" class="form-control" id="txtNombre" name="txtNombre" required>
            </div>
          </div>

        </form>

      </div>

    </div>

  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  
</body>
</html>